<?php

namespace DepartmentSite\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;



/**
 * Image
 *
 * @ORM\Table(name="Image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Image implements JsonSerializable
{
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
        return $this->getImage();
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
     * @param string $image
     *
     * @return Image
     */
    public function setImage( $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return string
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'image' => $this->image,
            'gallery' => $this->gallery->getTitle()
        ];
    }

    
    

    
}
