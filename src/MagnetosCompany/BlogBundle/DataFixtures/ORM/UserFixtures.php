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
        $roles = [['ROLE_ADMIN',], ['ROLE_USER',],];
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setName('User'.$i);
            $user->setPassword(123+$i);
            $user->setEmail("myemail@coma.su".$i);
            $user->setPlainPassword(123+$i);
            $user->setRoles($roles[array_rand($roles, 1)]);
            $manager->persist($user);
        }
        $manager->flush();
        $this->addReference('user', $user);
    }
}