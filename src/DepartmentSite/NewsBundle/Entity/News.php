<?php

namespace DepartmentSite\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="News")
 * @ORM\HasLifecycleCallbacks
 */

class News
{
		/**
	     * @ORM\Column(type="integer")
	     * @ORM\Id
	     * @ORM\GeneratedValue(strategy="AUTO")
	     */
		protected $id;

		/**
	    * @ORM\Column(type="string", length=256)
	    */
		protected $description;

		/**
	    * @ORM\Column(type="string", length=256)
	    */
		protected $title;

		/**
	     * @ORM\Column(type="text")
	     */
		protected $content;

		/**
	     * @ORM\Column(type="datetime")
	     */
		protected $createdAt;

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
     * Set descritpion
     *
     * @param string $description
     *
     * @return News
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get descritpion
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return News
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
     * Set content
     *
     * @param string $content
     *
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return News
		 * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
