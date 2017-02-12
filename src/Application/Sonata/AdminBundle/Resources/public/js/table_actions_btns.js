'use strict';

$(document).ready(function ($) {
    var isDOMChangeHandled = true;

    changeTableView("div[id*='_images']");
    changeTableView("div[id*='_socialNetworkLinks']");

    /**
     * Метод, выполняющий начальную отрисовку таблицы
     * @param selector
     * @param columnName
     */
    function changeTableView(selector, columnName) {
        if(columnName == undefined)
            columnName = "Номер";
        $(selector+ ' div.checked').closest('tr').remove();
        $(selector+ ' table .checkbox').hide();

        //скрытие поля с Итоговой суммой, потому что изначально оно не в таблице
        if(selector.indexOf("Cost") !== -1){
            var idPart = selector.split("'")[1];
            $("div[id$='total"+ idPart[0].toUpperCase() + idPart.substring(1) +"']").hide();
        }

        startTableInit(selector, columnName);
        moveActionTh(selector);
        addButtonClickEvent(selector, columnName);
        bindDOMSubtreeModified(selector, columnName);
    }

    function addButtonClickEvent(btnSelector) {
        $('body').on('click', btnSelector + " .sonata-ba-action", function() {
            isDOMChangeHandled = false;
        });
    }

    /**
     * Функция, связывающая блок под селектором с функцией
     * обработки изменения содержимого этого блока
     * @param selector
     * @param columnName
     */
    function bindDOMSubtreeModified(selector, columnName) {
        if(columnName == undefined)
            columnName = "Номер";
        $(selector).bind ("DOMSubtreeModified", function() {
            handleDOMChangeWithDelay(selector, columnName)
        });
    }

    /**
     * Обработка изменения блока с таблицей с задержкой
     * @param selector
     * @param columnName
     */
    function handleDOMChangeWithDelay (selector, columnName) {
        setTimeout (function() {
            handleDOMChange(selector, columnName)
        }, 1);
    }

    /**
     * Обработка изменения содержимого таблицы
     * @param selector
     * @param columnName
     */
    function handleDOMChange (selector, columnName) {
        if(!isDOMChangeHandled) {
            $(selector + " .sonata-ba-action").remove();
            //перерисовка таблицы
            startTableInit(selector);

            //сдвиг столбца с кнопками действий
            moveActionTh(selector);

            $('table .checkbox').hide();
            //установка флага обработанного изменения DOM
            isDOMChangeHandled = true;
        }
    }

    /**
     * Обработка клика на кнопку удаления
     */
    $('body').on('click', '#delete_btn', function() {
        //всплывающее окно с вопросом
        var answer = confirm("Вы уверены?");

        //если подтверждено
        if(answer) {
            //скрывает удаляему строку
            $(this).closest('tr').addClass("rowHidden").hide();

            //вызов события клика на стандартном чекбоксе удаления
            $(this).siblings('div.checkbox').find('div.icheckbox_square-blue').trigger('click');

            //переиндексация таблицы
            indexTable($(this));
        }
    });


    /**
     * Обработка клика на кнопку добавления новой записи в таблицу, если нет других записей
     */
    $('body').on('click', '#add_btn_0', function() {
        //показывает первую строку
        var $currentTr = $(this).siblings('div.sonata-ba-field').find('table tbody tr:first').show();

        //очищение областей ввода
        clearNewRow($currentTr.find('input'));
        clearNewRow($currentTr.find('textarea'));

        //инициализация iCheck
        $currentTr.find('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });

        //удаление лишнего блока ins
        $currentTr.find('div.icheckbox_square-blue').next('ins').remove();

        //если чекбокс был выделен, удаляем выделение и иницируем клик
        if($currentTr.find('div.icheckbox_square-blue').hasClass('checked')){
            $currentTr.find('div.icheckbox_square-blue').removeClass('checked');
            $currentTr.find('div.icheckbox_square-blue').trigger('click');
        }

        //переиндексация таблицы
        indexTable($currentTr);

        //смена id и name в соответсвии с порядком следования
        $currentTr.nextAll('tr').find('input').each( function() {
            changeIdAndName($(this));
        });

        //смена id и name в соответсвии с порядком следования
        $currentTr.nextAll('tr').find('textarea').each( function() {
            changeIdAndName($(this));
        });

        //удаление кнопки добавления
        $(this).remove();
    });

    /**
     * Изменение id и name селектора
     * @param $selector
     */
    function changeIdAndName($selector) {
        //удаляет текущее значение области ввода
        $(this).val('');
        var id = $selector.attr('id');
        var name = $selector.attr('name');

        //regExp для поиска индекса в id
        var idRegEx = /_([0-9]+)_/;

        //regExp для поиска индекса в name
        var nameRegEx = /\[([0-9]+)\]/;

        if(!$selector.hasClass("select2-focusser") && !$selector.hasClass("select2-input")){
            var idNum = id.match(idRegEx);
            var nameNum = name.match(nameRegEx);

            //увеличение индекса в id на 1
            $selector.attr('id', id.replace(idRegEx, '_'+ (parseInt(idNum[1])+1) + '_'));
            //увеличение индекса в name на 1
            $selector.attr('name', name.replace(nameRegEx, '['+ (parseInt(nameNum[1])+1) + ']'));
        }
    }

    /**
     * Очистка области ввода, удаление блока с ошибками
     * @param $selector
     */
    function clearNewRow($selector){
        $selector.each( function() {
            changeIdAndName($(this));
            $(this).val('');
            $(this).trigger('change');

            $(this).closest('td').find('div.help-inline').remove();
            if($(this).siblings("div[class*='itm_file']")) {
                $(this).siblings("div[class*='itm_file']").remove();
            }

            if($(this).siblings("div.phimagebuilder_widget_c")) {
                $(this).siblings("div.phimagebuilder_widget_c").remove();
            }

        });
    }

    /**
     * Обработка клика на кнопку добавления записи в таблицу
     */
    $('body').on('click', '#add_btn', function() {

            //поиск строки, в которой содержится кнопка
            var $currentTr = $(this).closest('tr');
            //клонирование строки
            var $newTr = $currentTr.clone();

            //очистка областей ввода
            clearNewRow($newTr.find('input'));
            clearNewRow($newTr.find('textarea'));

            //переинициализация iCheck
            $newTr.find('input[type="checkbox"]').unwrap().iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            //удаление ненужного блока ins
            $newTr.find('div.icheckbox_square-blue').next('ins').remove();

            //если чекбос был чекнут, удаляем класс checked и инициируем клик по нему
            if($newTr.find('div.icheckbox_square-blue').hasClass('checked')){
                $newTr.find('div.icheckbox_square-blue').removeClass('checked');
                $newTr.find('div.icheckbox_square-blue').trigger('click');
            }

            //вставляем склонированную строку после текущей
            $currentTr.after($newTr);

            //переиндексация таблицы
            indexTable($(this));

            //пересчёт id и name атрибутов для input
            $newTr.nextAll('tr').find('input').each( function() {
                //пропуск поля с итоговой суммой
                 if($(this).attr("id").indexOf("total") === -1 && !$(this).hasClass("select2-focusser"))
                    changeIdAndName($(this));
            });
    });

    /**
     * Метод начальной инициализации таблицы
     * @param selector
     * @param columnName
     */
    function startTableInit(selector, columnName) {
        //добавление колонки с номерами строк таблицы
        if(columnName == undefined)
            columnName = "Номер";
        $(selector + " table thead tr").each(function() {
          $(this).prepend('<th>' + columnName + '</th>');
        });
        $(selector + " table tbody tr").each(function(){
          $(this).prepend('<td class="selector_id"></td>');
        });
        //добавляет стили к каждому элементу первой колонки
        $(".selector_id").css({
            'width' : '5%',
            'text-align': 'center',
            'vertical-align' : 'middle',
            'top' : '50%'
        });

        //индексация таблицы
        $(selector + " tr").each(function () {
            indexTable($(this));
        })
    }

    /**
     * перемещение столбца удаления в конец таблицы
     * и перименовка его
     */
    function moveActionTh(selector){
        $(selector).find("th#action_th").each(function(){
            if(selector.indexOf("_documents") != -1)
                $(this).text('8. Действие');
            else
                $(this).text('Действие');
            $(this).closest('tr').append($(this));
        });

        $(selector+ ' tbody td:nth-child(2)').each(function() {
            $(this).closest('tr').append($(this));
        })
    }

    /**
     * Индексация таблицы
     * @param $selector
     * @returns {number}
     */
    function indexTable($selector) {

        //находим таблицу
        var $table = $selector.closest('table');
        var tableIndex = 0;

        //проходим по всем строкам таблицы
        $table.find('tbody tr').each(function() {
                //если строка не скрыта, увеличиваем индекс
                if($(this).css('display') != 'none'){
                    tableIndex++;
                }
                //вставляем индекс в колонку с индесами
                $(this).find('td.selector_id').text(tableIndex);
        });


        $table.find("tbody tr #delete_btn").attr("disabled", false);

        //если в таблице нет записей, то добавлить кнопку добавления
        if(tableIndex == 0){
            //удадение предыдущей кнопки добавления
            $selector.closest('div.form-group').find('button#add_btn_0').remove();
            //вставка новой кнопки
            $selector.closest('div.form-group').append('<button type="button" class="btn btn-success btn-sm" id="add_btn_0">' +
                '<i class="fa fa-plus-circle"></i> Добавить </button>');
        }
        else {
            //иначе удаление кнопки добавления
            $selector.closest('div.form-group').find('button#add_btn_0').remove();
        }

        return tableIndex;
    }
});
