<?php


namespace Application\FOS\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="Parent_user")
 * @UniqueEntity(fields = "username", targetClass = "Application\FOS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "Application\FOS\UserBundle\Entity\User", message="fos_user.email.already_used")
 *
 */
class ParentUser extends User implements \JsonSerializable
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
    protected $studentGroup;

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
     * @return ParentUser
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
     * @return ParentUser
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
     * @return ParentUser
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
     * @return ParentUser
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
     * Set studentGroup
     *
     * @param string $studentGroup
     *
     * @return ParentUser
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
     * Set patronymic
     *
     * @param string $patronymic
     *
     * @return ParentUser
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

    public function getType(){
        return parent::TYPE_PARENT;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'studentGroup' => $this->studentGroup,
            'username' => $this->username,
            'email' => $this->email
        ];
    }
}
