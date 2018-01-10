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
    public function indexAction()
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('@Blog/Page/home.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     */
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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Security("is_granted('ROLE_SU')")
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

            return $this->redirectToRoute('task_success');
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
        $roles = [['ROLE_ADMIN',], ['ROLE_USER',],];
        $r = array_rand($roles, 1);
        print_r($roles[$r]);

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
