<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use MagnetosCompany\BlogBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference('user');
        $category = $this->getReference('category');
        $tag = $this->getReference('tag');

        for ($i = 0; $i < 5; $i++) {
            $post = new Post();
            $post->setTitle('title '.$i);
            $post->setArticle('New article.....'.$i);
            $post->setUsers($user);
            $post->setCategories($category);
            $post->setTags($tag);
            $post->setCreated();
            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            CategoryFixtures::class,
            TagFixtures::class,
        );
    }
}