<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use MagnetosCompany\BlogBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $post = new Post();
            $post->setTitle('title '.$i);
            $post->setArticle('New article.....'.$i);
            $post->setCreated(date_create());
            $manager->persist($post);
        }

        $manager->flush();
    }
}