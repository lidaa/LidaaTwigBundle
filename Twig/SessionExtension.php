<?php

namespace Lidaa\TwigBundle\Twig;

class SessionExtension extends \Twig_Extension {

    private $session;

    public function initRuntime(\Twig_Environment $environment) {

        $globals = $environment->getGlobals();
        $this->session = $globals['app']->getSession();
    }

    public function getFunctions() {

        $fonctions = array();

        $fonctions['session_start'] = new \Twig_Function_Method($this, 'sessionStart');
        $fonctions['session_has'] = new \Twig_Function_Method($this, 'sessionHas');
        $fonctions['session_get'] = new \Twig_Function_Method($this, 'sessionGet');
        $fonctions['session_all'] = new \Twig_Function_Method($this, 'sessionAll');
        $fonctions['session_locale'] = new \Twig_Function_Method($this, 'sessionLocale');
        $fonctions['session_id'] = new \Twig_Function_Method($this, 'sessionId');
        $fonctions['session_flash'] = new \Twig_Function_Method($this, 'sessionFlash');
        $fonctions['session_regenerate'] = new \Twig_Function_Method($this, 'sessionRegenerate');

        return $fonctions;
    }

    public function sessionStart() {

        return $this->session->start();
    }

    public function sessionHas($name) {

        return $this->session->has($name);
    }

    public function sessionGet($name, $default = null) {

        return $this->session->get($name, $default);
    }

    public function sessionAll() {

        return $this->session->all();
    }

    public function sessionLocale() {

        return $this->session->getLocale();
    }

    public function sessionFlash($name, $default = null) {

        return $this->session->getFlash($name, $default);
    }

    public function sessionId() {

        return $this->session->getId();
    }

    public function sessionRegenerate($destroy = false) {

        if (!$destroy)
            return $this->session->migrate();

        return $this->session->storage->regenerate($destroy);
    }

    public function getName() {

        return 'session';
    }

}
