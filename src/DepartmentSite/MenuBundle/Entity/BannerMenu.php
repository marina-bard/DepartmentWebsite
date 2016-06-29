<?php

namespace DepartmentSite\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * BannerMenu
 *
 * @ORM\Table(name="Banner_Menu")
 * @ORM\Entity(repositoryClass="DepartmentSite\MenuBundle\Repository\BannerMenuRepository")
 */
class BannerMenu
{
    use ORMBehaviors\Sluggable\Sluggable;
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;


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
     * Set title
     *
     * @param string $title
     *
     * @return BannerMenu
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

    public function getSluggableFields()
    {
        return [ 'title' ];
    }
}

