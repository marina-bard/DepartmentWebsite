<?php

namespace DepartmentSite\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * Gallery
 *
 * @ORM\Table(name="Gallery")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Gallery
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
     * @ORM\OneToMany(targetEntity="Image", mappedBy="gallery")
     */
    private $images;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    
    


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
        $this->images[] = $image;
//        $image->setGallery($this);
//        $this->images->add($image);

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


}
