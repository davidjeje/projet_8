<?php
// tests/Controller/ClientControllerTest.php
namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SecurityControllerTest extends WebTestCase
{
    /**
    * @var \Doctrine\ORM\EntityManager
    */
    private $entityManager;

    
    public function testloginAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //Deuxième test
        // asserts that the response matches a given CSS selector.
        $this->assertGreaterThan(0, $crawler->filter('a')->count());

        //Troisième test
        $this->assertContains(
        'Mot de passe',
        $client->getResponse()->getContent()
        );

        //Septième test
        // asserts that there are exactly 1 h1 tags on the page
        $this->assertCount(0, $crawler->filter('h1'));
        
    }

    public function loginCheck()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login_check');
        
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
    }

    public function testLogoutCheck()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/logout');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
    }
}