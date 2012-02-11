<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

use Symfony\Component\Form\FormView;

/**
 * FormExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class FormExtension extends \Twig_Extension
{
    protected $resources;
    protected $blocks;
    protected $environment;
    protected $themes;
    protected $varStack;
    protected $template;

    public function __construct(array $resources = array())
    {
        $this->themes = new \SplObjectStorage();
        $this->varStack = array();
        $this->blocks = new \SplObjectStorage();
        $this->resources = $resources;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function setTheme(FormView $view, array $resources)
    {
        $this->themes->attach($view, $resources);
        $this->blocks = new \SplObjectStorage();
    }

    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['type_row'] = new \Twig_Function_Method($this, 'typeRow', array('is_safe' => array('html')));
        $fonctions['type_label'] = new \Twig_Function_Method($this, 'typeLabel', array('is_safe' => array('html')));
        $fonctions['type_widget'] = new \Twig_Function_Method($this, 'typeWidget', array('is_safe' => array('html')));
        $fonctions['type_errors'] = new \Twig_Function_Method($this, 'typeErrors', array('is_safe' => array('html')));

        return $fonctions;
    }

    public function typeRow(FormView $type, array $variables = array())
    {
        return $this->render($type, 'row', $variables);
    }

    public function typeLabel(FormView $type, array $variables = array())
    {
        return $this->render($type, 'label', $variables);
    }

    public function typeWidget(FormView $type, array $variables = array())
    {
        return $this->render($type, 'widget', $variables);
    }

    public function typeErrors(FormView $type, array $variables = array())
    {
        return $this->render($type, 'errors', $variables);
    }

    public function getName()
    {
        return 'lidaa.form';
    }

    protected function render(FormView $view, $section, array $variables = array())
    {
        $mainTemplate = in_array($section, array('widget', 'row'));
        if ($mainTemplate && $view->isRendered()) {
            return '';
        }

        if (null === $this->template) {
            $this->template = reset($this->resources);
            if (!$this->template instanceof \Twig_Template) {
                $this->template = $this->environment->loadTemplate($this->template);
            }
        }

        $custom = '_' . $view->get('id');
        $rendering = $custom . $section;

        $blocks = $this->getBlocks($view);

        if (isset($this->varStack[$rendering])) {
            $typeIndex = $this->varStack[$rendering]['typeIndex'] - 1;
            $types = $this->varStack[$rendering]['types'];
            $this->varStack[$rendering]['variables'] = array_replace_recursive($this->varStack[$rendering]['variables'], $variables);
        } else {
            $types = $view->get('types');

            $types[] = $custom;

            $typeIndex = count($types) - 1;

            $this->varStack[$rendering] = array(
                'variables' => array_replace_recursive($view->all(), $variables),
                'types' => $types,
            );
        }

        do {
            $types[$typeIndex] .= '_' . $section;

            if (isset($blocks[$types[$typeIndex]])) {

                $this->varStack[$rendering]['typeIndex'] = $typeIndex;

                // we do not call renderBlock here to avoid too many nested level calls (XDebug limits the level to 100 by default)
                ob_start();
                $this->template->displayBlock($types[$typeIndex], $this->varStack[$rendering]['variables'], $blocks);

                $html = ob_get_clean();

                if ($mainTemplate) {
                    $view->setRendered();
                }

                unset($this->varStack[$rendering]);

                return $html;
            }
        } while (--$typeIndex >= 0);

        throw new FormException(sprintf(
                        'Unable to render the form as none of the following blocks exist: "%s".', implode('", "', array_reverse($types))
        ));
    }

    protected function getBlocks(FormView $view)
    {
        if (!$this->blocks->contains($view)) {

            $rootView = !$view->hasParent();

            $templates = $rootView ? $this->resources : array();

            if (isset($this->themes[$view])) {
                $templates = array_merge($templates, $this->themes[$view]);
            }

            $blocks = array();

            foreach ($templates as $template) {
                if (!$template instanceof \Twig_Template) {
                    $template = $this->environment->loadTemplate($template);
                }
                $templateBlocks = array();
                do {
                    $templateBlocks = array_merge($template->getBlocks(), $templateBlocks);
                } while (false !== $template = $template->getParent(array()));
                $blocks = array_merge($blocks, $templateBlocks);
            }

            if (!$rootView) {
                $blocks = array_merge($this->getBlocks($view->getParent()), $blocks);
            }

            $this->blocks->attach($view, $blocks);
        } else {
            $blocks = $this->blocks[$view];
        }

        return $blocks;
    }
}