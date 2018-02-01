<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use MagnetosCompany\BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    private $comments = [
        "It's the possibility of having a dream come true that makes life interesting",
        "I cannot fix on the hour, or the spot, or the look or the words, which laid
             the foundation. It is too long ago. I was in the middle before I knew that I had begun",
        "There is no greater agony than bearing an untold story inside you",
    ];

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < count($this->comments); $i++) {
            //$user = $this->getReference('user1');
            $article = $this->getReference('post'.rand(0, 3));
            $comment = new Comment();
            $comment->setText($this->comments[$i]);
            $comment->setUser('user'.$i);
            $comment->setArticle($article);
            $manager->persist($comment);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            PostFixtures::class
        );
    }

}