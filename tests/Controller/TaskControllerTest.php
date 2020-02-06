<?php 
// tests/Controller/ClientControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Task;

class TaskControllerTest extends WebTestCase
{
    /**
    * @var \Doctrine\ORM\EntityManager
    */
    private $entityManager;

    
    public function testGetlistAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/tasks');
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //Deuxième test
        // asserts that there are exactly 1 h1 tags on the page
        $this->assertCount(12, $crawler->filter('h4'));       
    }

    public function testCreateAction()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/tasks/create');
        
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());    
    }

    public function testEditAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/tasks/{id}/edit');
        // Premier test
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        //Quatrième test
        // asserts that the response matches a given CSS selector.
        $this->assertGreaterThan(0, $crawler->filter('a')->count());

    }

    public function testToggleTaskAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/tasks/{id}/toggle');
        // Premier test
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        
    }

    public function testDeleteTaskAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/tasks/{id}/delete');
        // Premier test
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        
    } 

    


}