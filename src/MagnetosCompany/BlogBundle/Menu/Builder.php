<?php

namespace MagnetosCompany\BlogBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
    $menu = $factory->createItem('root');

    $menu->addChild('Главная', ['route' => 'blog_homepage']);
    $menu->addChild('Добавить статью', ['route' => 'blog_add_post']);
    $menu->addChild('Контакты', ['route' => 'blog_admin']);
    $menu->addChild('Регистрация', ['route' => 'blog_register']);
    $menu->addChild('Войти', ['route' => 'blog_login']);

    return $menu;
    }
}