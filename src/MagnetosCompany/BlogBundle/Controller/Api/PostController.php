<?php

namespace MagnetosCompany\BlogBundle\Controller\Api;

use MagnetosCompany\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @Route("/api/posts")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        print_r($data);
        $post = new Post();
        $post->setTitle($data['title']);
        $post->setArticle($data['article']);
        $post->setLinkToImage($data['linkToImage']);
        $post->setCategories(null);
        $post->setUsers(null);
        $post->setCreated();

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('It worked. Believe me - I\'m an API');
    }
}
