<?php

namespace DepartmentSite\DictionaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * DictionaryTranslation
 *
 * @ORM\Table(name="Dictionary_translation")
 * @ORM\Entity(repositoryClass="DepartmentSite\DictionaryBundle\Repository\DictionaryTranslationRepository")
 */
class DictionaryTranslation
{
    use ORMBehaviors\Translatable\Translation;
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * Set value
     *
     * @param string $value
     *
     * @return DictionaryTranslation
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}

