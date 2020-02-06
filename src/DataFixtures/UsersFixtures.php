<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsersFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $admin->setEmail('admin@todolist.com');
        $admin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin);

        $admin = new User();
        $admin->setUsername('admin1');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin1'));
        $admin->setEmail('admin1@todolist.com');
        $admin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('user');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'user'));
        $user->setEmail('user@todolist.com');
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        $user = new User();
        $user->setUsername('user1');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'user1')); 
        $user->setEmail('user1@todolist.com');
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('user2');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'user2'));
        $user->setEmail('user2@todolist.com');
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);


        $task = new Task();
        $task->setTitle('Première tâche');
        $task->setContent('Aller manger à 13h avec Etienne');
        $manager->persist($task);

        $task = new Task();
        $task->setTitle('Deuxième tâche');
        $task->setContent('Aller chercher la voiture au garage à 11h');
        $manager->persist($task);
        
        $task = new Task();
        $task->setTitle('Troisième tâche');
        $task->setContent('Faire les courses à 17h');
        $manager->persist($task);    

        $manager->flush();
    }
}
