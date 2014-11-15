<?php

namespace Diario\ProfessorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiarioProfessorBundle:Default:index.html.twig');
    }
}
