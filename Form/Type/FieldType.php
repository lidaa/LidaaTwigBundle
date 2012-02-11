<?php

/*
* This file is part of the LidaaTwigBundle package.
*/

namespace Lidaa\TwigBundle\Form\Type;

use Symfony\Component\Form\Util\PropertyPath;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\EventListener\TrimListener;
use Symfony\Component\Form\Extension\Core\Validator\DefaultValidator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\Extension\Core\Type\FieldType as BaseFieldType;

/**
 * FieldType
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class FieldType extends BaseFieldType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        if (!is_array($options['html_row'])) {
            throw new FormException('The "html_row" option must be "array".');
        }
        if (!is_array($options['html_label'])) {
            throw new FormException('The "html_label" option must be "array".');
        }
        if (!is_array($options['html_widget'])) {
            throw new FormException('The "html_widget" option must be "array".');
        }
        if (!is_array($options['html_errors'])) {
            throw new FormException('The "html_errors" option must be "array".');
        }
        if (!is_array($options['html_error'])) {
            throw new FormException('The "html_error" option must be "array".');
        }

        if (!isset($options['html_error']['tag']) && !isset($options['html_errors']['tag'])) {
            $options['html_error']['tag'] = 'li';
            $options['html_errors']['tag'] = 'ul';
        }

        $builder
            ->setAttribute('html_row', array_merge(array('tag' => 'div', 'display_mode' => 'LEW'), $options['html_row']))
            ->setAttribute('html_label', array_merge(array('tag' => 'label'), $options['html_label']))
            ->setAttribute('html_widget', $options['html_widget'])
            ->setAttribute('html_errors', $options['html_errors'])
            ->setAttribute('html_error', $options['html_error'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form)
    {
        parent::buildView($view, $form);

        $view
            ->set('html_row', $form->getAttribute('html_row'))
            ->set('html_label', $form->getAttribute('html_label'))
            ->set('html_widget', $form->getAttribute('html_widget'))
            ->set('html_errors', $form->getAttribute('html_errors'))
            ->set('html_error', $form->getAttribute('html_error'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        $defaultOptions = parent::getDefaultOptions($options);

        $defaultOptions['html_row'] = array();
        $defaultOptions['html_label'] = array();
        $defaultOptions['html_widget'] = array();
        $defaultOptions['html_errors'] = array();
        $defaultOptions['html_error'] = array();

        return $defaultOptions;
    }

}
