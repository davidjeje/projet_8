<?php
// tests/Controller/ClientControllerTest.php
namespace App\Tests\Controller; 
 
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Task;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserControllerTest extends WebTestCase
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

    public function testAddRemoveTask()
    {
        $user= New User();
        $task= New Task();
        $user->addTask($task);

        $listTask = $user->getTask();

        $this->assertEquals(1, count($listTask));

        $user->removeTask($task);
        $this->assertEquals(0, count($listTask));
    }

    public function testGetListAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $crawler = $client->request('GET', '/users');
        // Premier test
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        //Troisième test
        // asserts that the response matches a given CSS selector.
        $this->assertGreaterThan(0, $crawler->filter('a')->count());

        
    }

    public function testCreateAction() 
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $crawler = $client->request('GET', '/users/create');


        $form = $crawler->selectButton('Ajouter')->form();

        // set some values
        $form['user[username]'] = 'user105';
        $form['user[password][first]'] = 'user105';
        $form['user[password][second]'] = 'user105';
        $form['user[email]'] = 'user105ToDoList@gmail.com';
        $form['user[roles]']->select('ROLE_USER');

        // submit the form
        $crawler = $client->submit($form);
        
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
    }

    public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);

        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => 'user20']);

        $crawler = $client->request('POST', '/users/'.$user->getId().'/edit');

        $form = $crawler->selectButton('Modifier')->form();

        // set some values
        $form['user[username]'] = 'user201';
        $form['user[password][first]'] = 'user20';
        $form['user[password][second]'] = 'user20';
        $form['user[email]'] = 'user20ToDoList@gmail.com';
        $form['user[roles]']->select('ROLE_USER');

        // submit the form
        $crawler = $client->submit($form);
        
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        //Deuxième test
        //$this->assertCount(1, $crawler->filter('h1')); 
    }

}