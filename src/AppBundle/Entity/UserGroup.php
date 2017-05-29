<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 24.05.17
 * Time: 19:33
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
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

    /**
     * @param ArrayCollection $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }








}