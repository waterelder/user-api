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
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function getUserStates() : array
    {
        return UserState::getAll();
    }

    /**
     * @ORM\ManyToOne(targetEntity="UserGroup")
     * @ORM\JoinColumn(name="userGroup", referencedColumnName="id", nullable=false)
     * @Serializer\Exclude
     */
    private $userGroup;

    public function getUserGroup() : UserGroup
    {
        return $this->userGroup;
    }

    public function setUserGroup(?UserGroup $userGroup)
    {
        $this->userGroup = $userGroup;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;
    }

    public function getState() : string
    {
        return $this->state;
    }

    public function setState(?string $state)
    {
        $this->state = $state;
    }

    public function getCreatedAt() : DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
}