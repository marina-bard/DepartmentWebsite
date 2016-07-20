<?php


namespace Application\FOS\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="Student_user")
 * @UniqueEntity(fields = "username", targetClass = "Application\FOS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "Application\FOS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class StudentUser extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $surname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $patronymic;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $studyGroup;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Student
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set partonymic
     *
     * @param string $partonymic
     *
     * @return Student
     */
    public function setPartonymic($partonymic)
    {
        $this->partonymic = $partonymic;

        return $this;
    }

    /**
     * Get partonymic
     *
     * @return string
     */
    public function getPartonymic()
    {
        return $this->partonymic;
    }

    /**
     * Set group
     *
     * @param string $group
     *
     * @return Student
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set studyGroup
     *
     * @param string $studyGroup
     *
     * @return Student
     */
    public function setStudyGroup($studyGroup)
    {
        $this->studyGroup = $studyGroup;

        return $this;
    }

    /**
     * Get studyGroup
     *
     * @return string
     */
    public function getStudyGroup()
    {
        return $this->studyGroup;
    }

    /**
     * Set patronymic
     *
     * @param string $patronymic
     *
     * @return Student
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    /**
     * Get patronymic
     *
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }
}
