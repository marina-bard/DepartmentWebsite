<?php

namespace DepartmentSite\ProjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Project
 *
 * @ORM\Table(name="Project")
 * @ORM\Entity(repositoryClass="DepartmentSite\ProjectBundle\Repository\ProjectRepository")
 */
class Project
{
    use ORMBehaviors\Timestampable\Timestampable;
    use ORMBehaviors\Sluggable\Sluggable;
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
     * @var string
     *
     * @ORM\Column(name="student", type="string", length=255)
     */
    private $student;

    /**
     * @var string
     *
     * @ORM\Column(name="teacher", type="string", length=255, nullable=true)
     */
    private $teacher;

    /**
     * @var string
     *
     * @ORM\Column(name="reviewer", type="string", length=255, nullable=true)
     */
    private $reviewer;

    /**
     * @var int
     *
     * @ORM\Column(name="course", type="integer")
     */
    private $course;

    /**
     * @var string
     *
     * @ORM\Column(name="studentGroup", type="string", length=255)
     */
    private $studentGroup;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="isModerated", type="boolean")
     */
    private $isModerated;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="project")
     *
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

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
     * @return Project
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
     * Set student
     *
     * @param string $student
     *
     * @return Project
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return string
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set teacher
     *
     * @param string $teacher
     *
     * @return Project
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return string
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set reviewer
     *
     * @param string $reviewer
     *
     * @return Project
     */
    public function setReviewer($reviewer)
    {
        $this->reviewer = $reviewer;

        return $this;
    }

    /**
     * Get reviewer
     *
     * @return string
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * Set course
     *
     * @param integer $course
     *
     * @return Project
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return int
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set studentGroup
     *
     * @param string $studentGroup
     *
     * @return Project
     */
    public function setStudentGroup($studentGroup)
    {
        $this->studentGroup = $studentGroup;

        return $this;
    }

    /**
     * Get studentGroup
     *
     * @return string
     */
    public function getStudentGroup()
    {
        return $this->studentGroup;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Project
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Project
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
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
     * Set content
     *
     * @param string $content
     *
     * @return Project
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
     * Set isModerated
     *
     * @param boolean $isModerated
     *
     * @return Project
     */
    public function setIsModerated($isModerated)
    {
        $this->isModerated = $isModerated;

        return $this;
    }

    /**
     * Get isModerated
     *
     * @return bool
     */
    public function getIsModerated()
    {
        return $this->isModerated;
    }

    public function getSluggableFields()
    {
        return ['title'];
    }

    /**
     * Add comment
     *
     * @param \DepartmentSite\ProjectBundle\Entity\Comment $comment
     *
     * @return Project
     */
    public function addComment(\DepartmentSite\ProjectBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \DepartmentSite\ProjectBundle\Entity\Comment $comment
     */
    public function removeComment(\DepartmentSite\ProjectBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
