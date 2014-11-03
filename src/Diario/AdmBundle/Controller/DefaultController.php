<?php

namespace Diario\AdmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiarioAdmBundle:Default:index.html.twig');
    }
}
