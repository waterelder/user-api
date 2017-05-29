<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
    public function testUsers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testGroups()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groups/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
