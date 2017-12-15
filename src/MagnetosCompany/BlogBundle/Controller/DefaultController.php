<?php

namespace MagnetosCompany\BlogBundle\Controller;

use MagnetosCompany\BlogBundle\Entity\User;
use MagnetosCompany\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = new User();
        $user->setName('Alex');
        $user->setPassword('111');
        $post = new Post();
        $post->setTitle('Title1');
        $post->setArticle('Article1');
        $post->setCreated(date_create());
        $post->setUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($post);
        $em->flush();

        return new Response(
            'Saved new product with title: '.$post->getTitle()
            .' and new category with name: '.$user->getName()
        );
    }


}
