<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 24.05.17
 * Time: 19:33
 */

namespace AppBundle\Entity;
use JMS\Serializer\Annotation as JMS;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
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
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

}