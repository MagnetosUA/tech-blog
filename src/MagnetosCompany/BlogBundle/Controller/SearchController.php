<?php

namespace MagnetosCompany\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function searchAction(Request $request, $word)
    {
        $results = $this->getDoctrine()->getRepository('BlogBundle:Post')->search($word)->getResult();

        return $this->render('BlogBundle:Page:serach_results.html.twig', [
            'results' => $results,
        ]);
    }
}
