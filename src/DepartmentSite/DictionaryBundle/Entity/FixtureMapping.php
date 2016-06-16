<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 15.6.16
 * Time: 23.48
 */

namespace DepartmentSite\DictionaryBundle\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

trait FixtureMapping
{
    public function getValueByCode($code, $dictionaries)
    {
        try {
            foreach ($dictionaries as $dictionary) {
                if ($dictionary->getCode() == $code)
                    return $dictionary->getValue();
            }
            throw new Exception($code);
        }
        catch (Exception $e){
            echo 'value of fixture dictionary not found by' . $e->getMessage() . 'key';
        }
    }
}