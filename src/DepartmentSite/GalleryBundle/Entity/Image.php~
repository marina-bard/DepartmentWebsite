<?php

namespace DepartmentSite\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * Image
 *
 * @ORM\Table(name="Image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Image
{
    use ORMBehaviors\Sluggable\Sluggable;
    use ORMBehaviors\Timestampable\Timestampable;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="images", cascade={"persist"})
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     */
    private $gallery;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     */
    private $image;


    /**
     * @return string - object's string representation
     */
    public function __toString() {
        return $this->getTitle() ? : '-';
    }




    public function getSluggableFields()
    {
        return [ 'title' ];
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     *
     * @param \DepartmentSite\GalleryBundle\Entity\Gallery $image
     *
     * @return Image
     */
    public function setImage(\DepartmentSite\GalleryBundle\Entity\Gallery $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \DepartmentSite\GalleryBundle\Entity\Gallery
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set gallery
     *
     * @param \DepartmentSite\GalleryBundle\Entity\Gallery $gallery
     *
     * @return Image
     */
    public function setGallery(\DepartmentSite\GalleryBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \DepartmentSite\GalleryBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
