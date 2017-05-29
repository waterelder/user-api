<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 24.05.17
 * Time: 19:33
 */

namespace AppBundle\Entity;

use AppBundle\Enum\UserState;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Hateoas\Configuration\Annotation as Hateoas;


/**
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *         "get_user",
 *         parameters = { "id" = "expr(object.getId())" }
 *     ),
 * )
 * @Hateoas\Relation(
 *      "all_users",
 *      href = @Hateoas\Route(
 *          "get_all_users"
 *      ),
 * )
 * @Hateoas\Relation(
 *     "userGroup",
 *      href =  @Hateoas\Route(
 *         "get_group",
 *         parameters = { "id" = "expr(object.getUserGroup().getId())" }
 *     ),
 *     embedded = @Hateoas\Embedded(
 *         "expr(object.getUserGroup())",
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = {"users"})
 * )
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="First name can't be empty")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Second name can't be empty")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Email(message="Please provide a valid email")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(callback = "getUserStates", message="Please provide correct state")
     */
    private $state;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * User constructor.
     * @param $createdAt
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
    }


    public static function getUserStates()
    {
        return UserState::getAll();
    }


    /**
     * @ORM\ManyToOne(targetEntity="UserGroup")
     * @ORM\JoinColumn(name="userGroup", referencedColumnName="id", nullable=false)
     * @Serializer\Exclude
     */
    private $userGroup;

    /**
     * @return UserGroup
     */
    public function getUserGroup()
    {
        return $this->userGroup;
    }

    /**
     * @param UserGroup $userGroup
     */
    public function setUserGroup($userGroup)
    {
        $this->userGroup = $userGroup;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


}