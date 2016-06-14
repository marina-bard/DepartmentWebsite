<?php

namespace DepartmentSite\DictionaryBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;

/**
 * Dictionary
 *
 * @ORM\Entity(repositoryClass="DepartmentSite/DictionaryBundle/Repository/DictionaryRepository.php")
 * @ORM\Table(name="Dictionary")
 */
class Dictionary
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     */
    private $code = 'VK_LINK';

    private $title = 'Ссылка Vkontakte';

    private $value = 'Значение';
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dictionary
     *
     * @param array $dictionary
     *
     * @return Dictionary
     */
    public function setDictionary($dictionary)
    {
        $this->dictionary = $dictionary;

        return $this;
    }

    /**
     * Get dictionary
     *
     * @return array
     */
    public function getDictionary()
    {
        return $this->dictionary;
    }
    //use ORMBehaviors\Sluggable\Sluggable;
    //use ORMBehaviors\Timestampable\Timestampable;

}

