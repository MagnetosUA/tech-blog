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

class DefaultController extends Controller
{

    public function indexAction()
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find(18);
        return $this->render('@Blog/Page/home.html.twig', [
            'post' => $post,
        ]);
    }

    public function addUserAction(Request $request)
    {
        $user= new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('@Blog/Default/index.html.twig', [
            'form' => $form->createView(),
            'who_is_it' => 'user',
        ]);
    }

    public function successAction()
    {
        return $this->render('@Blog/Default/success.html.twig');
    }

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

            return $this->redirectToRoute('task_success');
        }

        return $this->render('@Blog/Default/index.html.twig', [
            'form' => $form->createView(),
            'who_is_it' => 'post',
        ]);
    }

    public function expAction()
    {
        $em = $this->getDoctrine()->getManager();
        $category = $this->getDoctrine()->getRepository(Category::class)->find(22);
        $em->remove($category);
        $em->flush();
        return $this->render('@Blog/Default/exp.html.twig');
    }

    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
