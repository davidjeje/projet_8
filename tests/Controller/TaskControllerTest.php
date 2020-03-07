<?php 
// tests/Controller/ClientControllerTest.php
namespace App\Tests\Controller; 

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Task;
use Symfony\Component\DomCrawler\Crawler; 

class TaskControllerTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
   
    public function testGetlistAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'user',
        ]);
        $crawler = $client->request('GET', '/tasks');
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());       
    }

    public function testCreateAction() 
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'user',
        ]);
        $crawler = $client->request('POST', '/tasks/create');
        
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->followRedirects();

        $form = $crawler->selectButton('Ajouter')->form();

        // set some values
        $form['task[title]'] = 'cinquième tâche test';
        $form['task[content]'] = 'cinquième tâche test';

        // submit the form
        $crawler = $client->submit($form);
    }

    public function testEditAction()
    {

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'user',
        ]);

        $task = $this->entityManager
            ->getRepository(Task::class)
            ->findOneBy(['id' => '43']);

        $crawler = $client->request('POST', '/tasks/'.$task->getId().'/edit');
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //Quatrième test
        // asserts that the response matches a given CSS selector.
        $this->assertGreaterThan(0, $crawler->filter('a')->count());   

        $form = $crawler->selectButton('Modifier')->form();

        // set some values
        $form['task[title]'] = 'quatrième tâche test';
        $form['task[content]'] = 'quatrième tâche test';

        // submit the form
        $crawler = $client->submit($form);

    }

    public function testToggleTaskAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'user',
        ]);

        $task = $this->entityManager
            ->getRepository(Task::class)
            ->findOneBy(['id' => '44']);

        $crawler = $client->request('GET', '/tasks/'.$task->getId().'/toggle');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());      
    }

    public function testDeleteTaskAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'user',
        ]);

        $task = $this->entityManager
            ->getRepository(Task::class)
            ->findOneBy(['id' => '46']);

        $crawler = $client->request('GET', '/tasks/'.$task->getId().'/delete');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
    }  

}