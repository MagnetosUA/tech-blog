<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use MagnetosCompany\BlogBundle\Entity\Tag;

class TagFixtures extends Fixture
{
    private $tags = ['Датчик', 'Устройство', 'Альтернативная энергия', 'Искуственный', 'Нейронная сеть', 'Скрорость', 'Производительность'];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->tags); $i++) {
            $tag = new Tag();
            $tag->setName($this->tags[$i]);
            $manager->persist($tag);
            $this->addReference('tag'.$i, $tag);
        }
        $manager->flush();

    }
}