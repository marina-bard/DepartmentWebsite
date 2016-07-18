<?php

namespace DepartmentSite\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * BannerMenuTranslation
 *
 * @ORM\Table(name="Banner_Menu_Translation")
 * @ORM\Entity(repositoryClass="DepartmentSite\MenuBundle\Repository\BannerMenuTranslationRepository")
 */
class BannerMenuTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return BannerMenuTranslation
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
}

