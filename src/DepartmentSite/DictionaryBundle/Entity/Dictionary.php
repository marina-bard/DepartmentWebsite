<?php

namespace DepartmentSite\DictionaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Dictionary
 *
 * @ORM\Table(name="Dictionary")
 * @ORM\Entity(repositoryClass="DepartmentSite\DictionaryBundle\Repository\DictionaryRepository")
 */
class Dictionary
{
    use ORMBehaviors\Translatable\Translatable;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @return string - object's string representation
     */
    public function __toString() {
        return $this->getCode() ? : '-';
    }


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
     * Set code
     *
     * @param string $code
     *
     * @return Dictionary
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}

