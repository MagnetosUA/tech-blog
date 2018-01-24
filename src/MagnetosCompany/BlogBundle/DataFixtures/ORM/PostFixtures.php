<?php

namespace MagnetosCompany\BlogBundle\DataFixtures\ORM;

use MagnetosCompany\BlogBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture
{
    private $imagesLinks = [
        'https://www.walldevil.com/wallpapers/a77/wallpaper-ligth-abstract-horror-wallpapers.jpg',
        'http://wallpaper.metalship.org/walls/more-fun-than-tekken.jpg',
        'https://www.infoniac.ru/upload/medialibrary/2a3/2a3981ebb1f10ec75ecaa2201223db6a.jpg',
        'https://images1.popmeh.ru/upload/gallery/471/4711eb4581f0cccae03451b0452e0051.jpg',
        'https://imagecdn3.luxnet.ua/tv24/resources/photos/news/610x344_DIR/201712/902422.jpg?201712165817',
    ];
    private $articles = [
        'Внутри наших клеток есть аминокислота метионин, из которой образуются метильные группы. Они влияют на работу 
        генов, изменяя ее: какие-то гены начинают работать активнее, другие блокируются. Недавно было доказано, что
         в течение жизни происходят определенные изменения в расположении метильных групп в ДНК, и это напрямую
          связано с биологическим возрастом человека. Каждому возрасту соответствует своя модель метилирования
           ДНК (образно ее называют «эпигенетическими часами»).
         Сейчас исследователи определяют этот показатель по крови в научных лабораториях и уверяют,
          что скоро он станет общедоступным.',
        'Студентка Стэнфордского университета американка Элизабет Холмс усовершенствовала метод анализа крови настолько
         волшебным образом, что получила звание «королевы биотехнологий». У человека безболезненно берут всего каплю крови 
        (это больше похоже не на укол, а на прикосновение, говорят пациенты) и за несколько часов могут определить 
        до 70 показателей. ',
        'Основываясь на наблюдениях, мы сделали вывод, что Вселенная расширяется, это нельзя отрицать. Также нельзя 
        отрицать тот факт, что она ускоряется. По законам гравитации все должно, наоборот, 
        замедляться, готовясь к "Большому сжатию" – процессу обратному Большому взрыву, однако на деле все несколько иначе.',
        'Pleo — игрушечный динозавр от Калеба Чанга, способный оценивать обстановку, обучаться и выражать эмоции.
         Благодаря мощным сенсорам, 
        Pleo может различать цвета и их оттенки, реагировать на звуки и даже чувствовать еду или лекарства. Также
         он изображает процесс еды и сна.',
        'Компания под названием Samson Motors показала общественности свою первую серийную разработку - летающий
         автомобиль Switchblade. Трехколесное транспортное средство оснащено 1.6-литровым двигателем V4 
         способным развивать мощность 190 л.с. В режиме полета этот автомобиль сможет 
        достигать скорости в 320 км/ч и подниматься на высоту около четырех километров.',

    ];
    private $titles = [
        'Внутриклеточные часы проследят за старением',
        'Революционный анализ крови',
        'Каковы законы Вселенной?',
        'Pleo — игрушечный динозавр',
        'Летающий автомобиль',
    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $user = $this->getReference('user'.rand(0, 3));
            $category = $this->getReference('category'.$i);
            $tag = $this->getReference('tag'.$i);
            $post = new Post();
            $post->setTitle($this->titles[$i]);
            $post->setArticle($this->articles[$i]);
            $post->setLinkToImage($this->imagesLinks[$i]);
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