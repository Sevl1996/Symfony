<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/teams');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addTeam');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editTeam');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteTeam');
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/indexTeam');
    }

}
