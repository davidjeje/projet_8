<?php
// tests/Controller/ClientControllerTest.php
namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class UserControllerTest extends WebTestCase
{
    public function testGetListAction()
    {
        $client = static::createClient();
        //$crawler = $client->request('GET', '/users');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
        //Troisième test
        // asserts that the response matches a given CSS selector.
        $this->assertGreaterThan(0, $crawler->filter('a')->count());

        
    }

    public function testCreateAction()
    {
        $client = static::createClient();
        //$crawler = $client->request('GET', '/users/create');
        
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
    }

    public function testEditAction()
    {
        $client = static::createClient();
        //$crawler = $client->request('GET', '/users/{id}/edit');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        //Deuxième test
        $this->assertCount(0, $crawler->filter('h1')); 


    }

}