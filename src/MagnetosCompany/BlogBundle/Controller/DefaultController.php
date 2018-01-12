<?php

namespace MagnetosCompany\BlogBundle\Controller;

use MagnetosCompany\BlogBundle\Entity\Category;
use MagnetosCompany\BlogBundle\Entity\User;
use MagnetosCompany\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MagnetosCompany\BlogBundle\Form\Type\UserType;
use MagnetosCompany\BlogBundle\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class DefaultController
 * @package MagnetosCompany\BlogBundle\Controller
 *
 *
 */
class DefaultController extends Controller
{

    /**
     * @return Response
     * @Security("is_granted('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blog_homepage"));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $post, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        1/*limit per page*/
    );
        //var_dump($pagination);
        return $this->render('@Blog/Page/home.html.twig', [
            'post' => $post,
            'pagination' => $pagination,
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function addPostAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('blog_homepage');
        }

        return $this->render('@Blog/Default/index.html.twig', [
            'form' => $form->createView(),
            'who_is_it' => 'post',
        ]);
    }

    /**
     * @return Response
     *
     * @Security("is_granted('ROLE_USER')")
     */
    public function expAction()
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find(12);
        var_dump($post->getSlug());

        //echo $post->getSlug();
        return new Response('<html><body>exp</body></html>');

    }

    /**
     * @return Response
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
