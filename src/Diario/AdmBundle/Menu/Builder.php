<?php

namespace Diario\AdmBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {

        $usuario = $this->container->get('security.context')->getToken()->getUser();

        // This will add the proper classes to your UL
        // Use push_right if you want your menu on the right
        $menu = $factory->createItem('root', array(
            'navbar' => true,
            'pull-right' => true,
        ));

        // Regular menu item, no change
        $menu->addChild('Diario', array('route' => 'diario'));
        // $menu->addChild('Curso', array('route' => 'curso'));
        // $menu->addChild('Disciplina', array('route' => 'disciplina'));
        // $menu->addChild('Professor', array('route' => 'professor'));
        // $menu->addChild('Turma', array('route' => 'turma'));
        // $menu->addChild('Horario', array('route' => 'horario'));
        // $menu->addChild('Aluno', array('route' => 'aluno'));
        // $menu->addChild('Aula', array('route' => 'aula'));

        // Create a dropdown
        $dropdown = $menu->addChild($usuario, array(
            'dropdown' => true,
            'caret' => true,
        ));

        // Add child to dropdown, still normal KnpMenu usage
        $dropdown->addChild('Sair', array('route' => 'fos_user_security_logout'));

        return $menu;
    }
}
