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
        //$em->flush();

        $data = $this->serializePost($post);
        $response = new JsonResponse($data, 201);

        $postUrl = $this->generateUrl(
            'api_posts_show',
            ['title' => $post->getTitle()]
        );
        $response->headers->set('Location', $postUrl);


        return $response;

    }

    /**
     * @Route("/api/posts/{title}", name="api_posts_show")
     * @Method("GET")
     */
    public function showAction($title)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBy(['title' => $title]);
        if (!$post) {
            throw $this->createNotFoundException(sprintf(
                'No post found with title "%s"',
                $title
            ));
        }

        $data = $this->serializePost($post);
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/posts")
     * @Method("GET")
     */
    public function listAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();
        $data = ['posts' => []];
        foreach ($posts as $post) {
            $data['postss'][] = $this->serializePost($post);
        }
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    private function serializePost(Post $post)
    {
        return [
            'title' => $post->getTitle(),
            'article' => $post->getArticle(),
            'linkToImage' => $post->getLinkToImage(),
        ];
    }
}
