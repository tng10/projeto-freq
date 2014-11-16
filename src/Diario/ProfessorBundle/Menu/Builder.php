<?php

namespace Diario\ProfessorBundle\Menu;

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
        // $menu->addChild('Cursos', array('route' => 'professor_curso_index'));
        // $menu->addChild('Disciplinas', array('route' => 'professor_disciplina_index'));
        // $menu->addChild('Turmas', array('route' => 'professor_turma_index'));

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



/**
 * An example howto inject a default KnpMenu to the Navbar
 * see also Resources/config/example_menu.yml
 * and example_navbar.yml
 * @author phiamo
 *
 */
// class Builder
// {
//     public function createMainMenu(FactoryInterface $factory, array $options)
//     {
//         $menu = $factory->createItem('root', array(
//             'navbar' => true,
//         ));

//         $layout = $menu->addChild('Layout', array(
//             'icon' => 'home',
//             'uri' => '#mopa_bootstrap_layout_example',
//         ));

//         $dropdown = $menu->addChild('Forms', array(
//             'dropdown' => true,
//             'caret' => true,
//         ));

//         // $dropdown->addChild('Examples', array('route' => 'mopa_bootstrap_forms_examples'));
//         // $dropdown->addChild('Horizontal', array('route' => 'mopa_bootstrap_forms_horizontal'));
//         // $dropdown->addChild('Extended Forms', array('route' => 'mopa_bootstrap_forms_extended'));
//         // $dropdown->addChild('Extended Views', array('route' => 'mopa_bootstrap_forms_view_extended'));
//         // $dropdown->addChild('Embedded Type Forms', array('route' => 'mopa_bootstrap_forms_embeddedtype'));
//         // $dropdown->addChild('Forms Errors', array('route' => 'mopa_bootstrap_forms_errors'));
//         // $dropdown->addChild('Help Texts', array('route' => 'mopa_bootstrap_forms_helptexts'));
//         // $dropdown->addChild('Choice Fields', array('route' => 'mopa_bootstrap_forms_choices'));
//         // $dropdown->addChild('Collections Fields', array('route' => 'mopa_bootstrap_forms_collections'));
//         // $dropdown->addChild('Form Tabs', array('route' => 'mopa_bootstrap_forms_tabs'));

//         // $menu->addChild('Menus & Navbars', array('route' => 'mopa_bootstrap_navbar'));
//         // $menu->addChild('Macros for components', array('route' => 'mopa_bootstrap_components'));

//         return $menu;
//     }

//     public function createNavbarsSubnavMenu(FactoryInterface $factory, array $options)
//     {
//         $menu = $factory->createItem('root', array(
//             'subnavbar' => true,
//         ));

//         $menu->addChild('Top', array('uri' => '#top'));
//         $menu->addChild('Menus', array('uri' => '#menus'));
//         $menu->addChild('Navbars', array('uri' => '#navbars'));
//         $menu->addChild('Template', array('uri' => '#template'));
//         // ... add more children
//         return $menu;
//     }

//     public function createComponentsSubnavMenu(FactoryInterface $factory, array $options)
//     {
//         $menu = $factory->createItem('root', array(
//             'subnavbar' => true,
//         ));

//         $menu->addChild('Top', array('uri' => '#top'));
//         $menu->addChild('Flashs', array('uri' => '#flashs'));
//         $menu->addChild('Session Flashs', array('uri' => '#session-flashes'));
//         $menu->addChild('Labels & Badges', array('uri' => '#labels-badges'));
//         // ... add more children
//         return $menu;
//     }
// }