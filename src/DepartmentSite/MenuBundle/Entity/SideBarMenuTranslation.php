<?php

namespace DepartmentSite\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SideBarMenuTranslation
 *
 * @ORM\Table(name="Side_Bar_Menu_Translation")
 * @ORM\Entity(repositoryClass="DepartmentSite\MenuBundle\Repository\SideBarMenuTranslationRepository")
 */
class SideBarMenuTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return SideBarMenuTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SideBarMenuTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

