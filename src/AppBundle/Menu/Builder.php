<?php
/**
 * Created by PhpStorm.
 * User: yasmin
 * Date: 02/04/18
 * Time: 11:25
 */

namespace AppBundle\Menu;


use Knp\Menu\MenuFactory;


class Builder
{
    public function mainMenu(MenuFactory $factory, array $options)
    {

        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', ' nav navbar-nav');
        $menu->addChild('ACCUEIL', ['route' =>'homepage']);
        $menu->addChild('PÉTITIONS', ['route' =>'Petition']);
        $menu->addChild('SONDAGES', ['route' =>'sondage']);
        $menu->addChild('CONTACTEZ-NOUS', ['route' =>'contact_new']);
        return $menu;


    }


}