<?php

namespace MagnetosCompany\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function registerAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
