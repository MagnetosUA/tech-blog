<?php

namespace MagnetosCompany\BlogBundle\Controller;

use MagnetosCompany\BlogBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MagnetosCompany\BlogBundle\Form\Type\UserType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $user= new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('@Blog/Default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function successAction()
    {
        return $this->render('@Blog/Default/success.html.twig');
    }
}
