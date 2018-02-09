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

    $menu
        ->addChild('Main', ['route' => 'blog_homepage'])
        ->setAttribute('class', 'nav-item active')
        ->setLinkAttribute('class', 'nav-link');

    $menu->setChildrenAttribute('class', 'navbar-nav ml-auto');
    $menu
        ->addChild('Add Post', ['route' => 'blog_add_post'])
        ->setAttribute('class', 'nav-item')
        ->setLinkAttribute('class', 'nav-link');
    $menu
        ->addChild('Sign up', ['route' => 'blog_register'])
        ->setAttribute('class', 'nav-item')
        ->setLinkAttribute('class', 'nav-link');
    $menu
        ->addChild('Sign out', ['route' => 'blog_login'])
        ->setAttribute('class', 'nav-item')
        ->setLinkAttribute('class', 'nav-link auth');

    return $menu;
    }
}