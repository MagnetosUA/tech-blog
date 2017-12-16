<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use MagnetosCompany\BlogBundle\Entity\Post;
use MagnetosCompany\BlogBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 3; $i++) {
            $category = new Category();
            $category->setName('Category'.$i);
            $manager->persist($category);
        }
        $manager->flush();
        $this->addReference('category', $category);
    }
}