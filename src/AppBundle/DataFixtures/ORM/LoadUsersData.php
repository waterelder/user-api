<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 19.04.17
 * Time: 15:00.
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;

use AppBundle\Enum\UserState;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsersData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $firstUser = new User();
        $firstUser->setFirstName("Ivan");
        $firstUser->setLastName("Ivanov");
        $firstUser->setEmail("ivanivanov@acme.com");
        $firstUser->setCreatedAt(new \DateTime());
        $firstUser->setState(UserState::ACTIVE);
        $firstUser->setUserGroup($this->getReference("firstGroup"));


        $manager->persist($firstUser);


        $secondUser = new User();
        $secondUser->setFirstName("Petr");
        $secondUser->setLastName("Petrov");
        $secondUser->setEmail("petrpetrov@acme.com");
        $secondUser->setCreatedAt(new \DateTime());
        $secondUser->setState(UserState::INACTIVE);
        $secondUser->setUserGroup($this->getReference("firstGroup"));


        $manager->persist($secondUser);


        $thirdUser = new User();
        $thirdUser->setFirstName("Michail");
        $thirdUser->setLastName("Michailov");
        $thirdUser->setEmail("michailmiichailov@acme.com");
        $thirdUser->setCreatedAt(new \DateTime());
        $thirdUser->setState(UserState::ACTIVE);
        $thirdUser->setUserGroup($this->getReference("secondGroup"));

        $manager->persist($thirdUser);


        $manager->flush();

    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
