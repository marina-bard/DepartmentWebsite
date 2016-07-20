<?php

namespace DepartmentSite\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;


/**
 * Gallery
 *
 * @ORM\Table(name="Gallery")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Gallery implements JsonSerializable
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="gallery", cascade={"persist"})
     */
    private $images;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

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
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Gallery
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
     * Add image
     *
     * @param \DepartmentSite\GalleryBundle\Entity\Image $image
     *
     * @return Gallery
     */
    public function addImage(\DepartmentSite\GalleryBundle\Entity\Image $image)
    {
        $image->setGallery($this);
        $this->images[] = $image;
        return $this;
    }
    

    /**
     * Remove image
     *
     * @param \DepartmentSite\GalleryBundle\Entity\Image $image
     */
    public function removeImage(\DepartmentSite\GalleryBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Gallery
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'id' => $this->id
        ];
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getFirstImage()
    {
        return $this->images[0]->getImage();
    }
}
