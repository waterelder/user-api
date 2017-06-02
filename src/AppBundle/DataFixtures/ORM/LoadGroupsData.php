<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\UserGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGroupsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $firstGroup = new UserGroup();
        $firstGroup->setName('XBOX Fans');

        $secondGroup = new UserGroup();
        $secondGroup->setName('PS4 Lovers');

        $manager->persist($firstGroup);
        $manager->persist($secondGroup);

        $manager->flush();

        $this->addReference('firstGroup', $firstGroup);
        $this->addReference('secondGroup', $secondGroup);
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
