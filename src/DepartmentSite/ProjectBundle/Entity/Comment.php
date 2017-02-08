<?php

namespace DepartmentSite\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Comment
 *
 * @ORM\Table(name="Comment")
 * @ORM\Entity(repositoryClass="DepartmentSite\ProjectBundle\Repository\CommentRepository")
 */
class Comment implements ORMBehaviors\Tree\NodeInterface, \ArrayAccess, \JsonSerializable
{
    use ORMBehaviors\Tree\Node;
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="comments")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_moderated", type="boolean", nullable=true,  options={"default" : 0})
     */
    private $isModerated;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->content;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
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
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author= $author;

        return $this;
    }

    /**
     * Set project
     *
     * @param \DepartmentSite\ProjectBundle\Entity\Project $project
     *
     * @return Comment
     */
    public function setProject(\DepartmentSite\ProjectBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \DepartmentSite\ProjectBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'content' => $this->content,
            'author' => $this->author,
            'child' => $this->getChildNodes()->toArray()
        ];
    }

    /**
     * Set isModerated
     *
     * @param boolean $isModerated
     *
     * @return Comment
     */
    public function setIsModerated($isModerated)
    {
        $this->isModerated = $isModerated;

        return $this;
    }

    /**
     * Get isModerated
     *
     * @return boolean
     */
    public function getIsModerated()
    {
        return $this->isModerated;
    }
}
