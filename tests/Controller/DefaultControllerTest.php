<?php
// tests/Controller/ClientControllerTest.php
namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest extends WebTestCase
{
    
    public function testIndexAction()
    {
        $client = static::createClient();
        //$crawler = $client->request('GET', '/');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        //Deuxième test
        // asserts that there are exactly 1 h1 tags on the page
        $this->assertCount(0, $crawler->filter('h1'));

        //Quatrième test
        // asserts that the response matches a given CSS selector.
        $this->assertGreaterThan(0, $crawler->filter('a')->count());

     
    }
}