<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

/**
 * SfExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class SfExtension extends \Twig_Extension
{
    private $app;

    public function initRuntime(\Twig_Environment $environment)
    {
        $globals = $environment->getGlobals();
        $this->app = $globals['app'];
    }

    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['controller_name'] = new \Twig_Function_Method($this, 'controllerName');
        $fonctions['action_name'] = new \Twig_Function_Method($this, 'actionName');
        $fonctions['get_env'] = new \Twig_Function_Method($this, 'getEnv');

        return $fonctions;
    }

    public function controllerName()
    {
        $request = $this->app->getRequest();
        $controller = $request->get('_controller');

        $controller_name = $this->getControllerName($controller);

        return $controller_name;
    }

    public function actionName()
    {
        $request = $this->app->getRequest();
        $controller = $request->get('_controller');

        $action_name = $this->getActionName($controller);

        return $action_name;
    }

    public function getEnv()
    {
        return $this->app->getEnvironment();
    }

    private function getControllerName($controller)
    {
        $tab_infos = explode('::', $controller);
        $contr_infos = explode('\\', $tab_infos[0]);

        return array_pop($contr_infos);
    }

    private function getActionName($controller)
    {
        $tab_infos = explode('::', $controller);

        return $tab_infos[1];
    }

    public function getName()
    {
        return 'sf';
    }
}
