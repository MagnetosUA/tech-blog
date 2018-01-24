<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use MagnetosCompany\BlogBundle\Entity\Post;
use MagnetosCompany\BlogBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture
{
    private $categories = ['Космос', 'Медицина', 'Транспорт', 'Электроника', 'Нанотехнологии'];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->categories); $i++) {
            $category = new Category();
            $category->setName($this->categories[$i]);
            $manager->persist($category);
            $this->addReference('category'.$i, $category);
        }
        $manager->flush();

    }
}