<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 24.05.17
 * Time: 19:33
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints;
use Hateoas\Configuration\Annotation as Hateoas;
/**
 * @ORM\Table(name="Groups")
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *         "get_group",
 *         parameters = { "id" = "expr(object.getId())" }
 *     ),
 * )
 * @Hateoas\Relation(
 *      "all_groups",
 *      href = @Hateoas\Route(
 *          "get_all_groups"
 *      ),
 * )
 * @Hateoas\Relation(
 *     "users",
 *      href =  @Hateoas\Route(
 *         "get_all_users",
 *     ),
 *     embedded = @Hateoas\Embedded(
 *         "expr(object.getUsers())",
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = {"groups"})
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 */
class UserGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"groups", "users"})
     *
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     * @Serializer\Groups({"groups", "users"})
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="userGroup", cascade={"persist"})
     * @Serializer\Exclude
     *
     */
    private $users;

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function setUsers(Collection $users)
    {
        $this->users = $users;
    }
}