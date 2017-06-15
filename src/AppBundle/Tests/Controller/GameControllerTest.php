<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/games');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addGame');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editGame');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteGame');
    }

}
