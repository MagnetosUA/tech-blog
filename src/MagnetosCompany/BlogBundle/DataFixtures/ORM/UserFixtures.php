<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use MagnetosCompany\BlogBundle\Entity\User;
use MagnetosCompany\BlogBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roles = [['ROLE_USER',], ['ROLE_ADMIN',],];
        $users = [
            'User0' => ['name' => 'Oleg', 'role' => $roles[0], 'email' => 'oleg@gmail.com'],
                'User1' => ['name' => 'Serge', 'role' => $roles[0], 'email' => 'serge@gmail.com'],
                    'User2' => ['name' => 'Kate', 'role' => $roles[0], 'email' => 'kate@gmail.com'],
                        'User3' => ['name' => 'Aleks', 'role' => $roles[1], 'email' => 'magnetos.ua@gmail.com'],
                ];

        for ($i = 0; $i < 4; $i++) {
            $user = new User();
            $user->setName($users['User'.$i]['name']);
            $user->setPassword(123);
            if ($users['User'.$i]['name'] == 'Aleks') {
                $user->setPassword(12345);
            }
            $user->setEmail($users['User'.$i]['email']);
            $user->setPlainPassword(123);
            if ($users['User'.$i]['name'] == 'Aleks') {
                $user->setPlainPassword(12345);
            }
            $user->setRoles($users['User'.$i]['role']);
            $manager->persist($user);
            $this->addReference('user'.$i, $user);
        }
        $manager->flush();

    }
}