<?php

namespace MagnetosCompany\BlogBundle\Controller;

use MagnetosCompany\BlogBundle\Entity\Category;
use MagnetosCompany\BlogBundle\Entity\User;
use MagnetosCompany\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user= $this->getDoctrine()->getRepository(User::class)->getUserByName('User0');
        $post = $this->getDoctrine()->getRepository(Post::class)->findByLastId();

        return $this->render('@Blog/Default/index.html.twig', [
            'user' => $user,
            'post' => $post,
        ]);
    }
}
