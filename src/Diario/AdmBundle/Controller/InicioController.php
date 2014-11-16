<?php

namespace Diario\AdmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InicioController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiarioAdmBundle:Inicio:index.html.twig');    
    }

}
