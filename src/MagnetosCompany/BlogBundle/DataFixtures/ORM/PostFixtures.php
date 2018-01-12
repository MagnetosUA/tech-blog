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
        for ($i = 0; $i < 5; $i++) {
            $user = $this->getReference('user'.$i);
            $category = $this->getReference('category'.$i);
            $tag = $this->getReference('tag'.$i);
            $post = new Post();
            $post->setTitle('title '.$i);
            $post->setArticle('New article.....'.$i);
            $post->setLinkToImage('https://static.pexels.com/photos/15286/pexels-photo.jpg');
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