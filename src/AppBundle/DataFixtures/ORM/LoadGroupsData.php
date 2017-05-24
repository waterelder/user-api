<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 19.04.17
 * Time: 15:27.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Api\Model\OrderState;
use AppBundle\Entity\Order;
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
