<?php

namespace MagnetosCompany\BlogBundle\Controller\Api;

use MagnetosCompany\BlogBundle\Entity\Post;
use MagnetosCompany\BlogBundle\Form\Type\PostType;
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
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->submit($data);
        $post->setTitle($data['title']);
        $post->setArticle($data['article']);
        $post->setLinkToImage($data['linkToImage']);
        $post->setCategories(null);
        $post->setUsers(null);
        $post->setCreated();

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        $response = new Response('It worked. Believe me - I\'m an API', 201);
        $response->headers->set('Location', '/some/programmer/url');
        return $response;

    }
}
