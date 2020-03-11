<?php
// tests/Controller/ClientControllerTest.php
namespace App\tests\Controller; 

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase; 
use Symfony\Component\DomCrawler\Crawler;


class DefaultControllerTest extends WebTestCase
{
    
    public function testIndexAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'user',
        ]);
        $crawler = $client->request('GET', '/');
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //Deuxième test
        // asserts that there are exactly 1 h1 tags on the page
        $this->assertCount(1, $crawler->filter('h1'));

        //Quatrième test
        // asserts that the response matches a given CSS selector.
        $this->assertGreaterThan(0, $crawler->filter('a')->count());

        /*$client->clickLink('Créer une nouvelle tâche');
        $client->clickLink('Consulter la liste des tâches à faire');*/

     
    }
}