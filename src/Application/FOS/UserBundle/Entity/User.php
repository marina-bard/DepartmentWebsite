<?php


namespace Application\FOS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

use FOS\UserBundle\Doctrine\UserManager;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"Student_user" = "StudentUser", "Parent_user" = "ParentUser", "Teacher_user" = "TeacherUser"})
 *
 */
abstract class User extends BaseUser
{

    const TYPE_STUDENT = 'Student';
    const TYPE_PARENT = 'Parent';
    const TYPE_TEACHER = 'Teacher';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    public function __toString() {
        return $this->getUsername() ? : '-';
    }

    abstract public function getType();


}
