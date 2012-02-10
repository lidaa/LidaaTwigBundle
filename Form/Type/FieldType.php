<?php

namespace Lidaa\TwigBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Util\PropertyPath;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\EventListener\TrimListener;
use Symfony\Component\Form\Extension\Core\Validator\DefaultValidator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\Exception\FormException;

class FieldType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        if (null === $options['property_path']) {
            $options['property_path'] = $builder->getName();
        }

        if (false === $options['property_path'] || '' === $options['property_path']) {
            $options['property_path'] = null;
        } else {
            $options['property_path'] = new PropertyPath($options['property_path']);
        }
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

        if(!isset($options['html_error']['tag']) && !isset($options['html_errors']['tag'])) {
            $options['html_error']['tag'] = 'li';
            $options['html_errors']['tag'] = 'ul';
        }
        
        $builder
            ->setRequired($options['required'])
            ->setErrorBubbling($options['error_bubbling'])
            ->setEmptyData($options['empty_data'])
            ->setAttribute('by_reference', $options['by_reference'])
            ->setAttribute('property_path', $options['property_path'])
            ->setAttribute('error_mapping', $options['error_mapping'])
            ->setAttribute('max_length', $options['max_length'])
            ->setAttribute('label', $options['label'] ?: $this->humanize($builder->getName()))
            ->setAttribute('html_row', array_merge(array('tag' => 'div', 'display_mode'  => 'LEW'), $options['html_row']))
            ->setAttribute('html_label', array_merge(array('tag' => 'label'), $options['html_label']))
            ->setAttribute('html_widget', $options['html_widget'])
            ->setAttribute('html_errors', $options['html_errors'])
            ->setAttribute('html_error', $options['html_error'])
            ->setAttribute('invalid_message', $options['invalid_message'])
            ->setAttribute('invalid_message_parameters', $options['invalid_message_parameters'])
            ->setData($options['data'])
            ->addValidator(new DefaultValidator())
        ;

        if ($options['trim']) {
            $builder->addEventSubscriber(new TrimListener());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form)
    {
        $name = $form->getName();

        if ($view->hasParent()) {
            $parentId = $view->getParent()->get('id');
            $parentFullName = $view->getParent()->get('full_name');
            $id = sprintf('%s_%s', $parentId, $name);
            $fullName = sprintf('%s[%s]', $parentFullName, $name);
        } else {
            $id = $name;
            $fullName = $name;
        }

        $types = array();
        foreach ($form->getTypes() as $type) {
            $types[] = $type->getName();
        }

        $html_widget = $form->getAttribute('html_widget');
        $html_widget['id'] = $id;
        $html_widget['name'] = $fullName;
                
        $view
            ->set('form', $view)
            ->set('id', $id)
            ->set('name', $name)
            ->set('full_name', $fullName)
            ->set('errors', $form->getErrors())
            ->set('value', $form->getClientData())
            ->set('required', $form->isRequired())
            ->set('max_length', $form->getAttribute('max_length'))
            ->set('size', null)
            ->set('label', $form->getAttribute('label'))
            ->set('multipart', false)
            ->set('html_row', $form->getAttribute('html_row'))
            ->set('html_label', $form->getAttribute('html_label'))
            ->set('html_widget', $html_widget)
            ->set('html_errors', $form->getAttribute('html_errors'))
            ->set('html_error', $form->getAttribute('html_error'))
            ->set('types', $types)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        $defaultOptions = array(
            'data'              => null,
            'data_class'        => null,
            'trim'              => true,
            'required'          => true,
            'max_length'        => null,
            'property_path'     => null,
            'by_reference'      => true,
            'error_bubbling'    => false,
            'error_mapping'     => array(),
            'label'             => null,
            'html_row'          => array(),
            'html_label'        => array(),
            'html_widget'       => array(),
            'html_errors'       => array(),
            'html_error'        => array(),
            'invalid_message'   => 'This value is not valid',
            'invalid_message_parameters' => array(),
        );

        $class = isset($options['data_class']) ? $options['data_class'] : null;

        // If no data class is set explicitly and an object is passed as data,
        // use the class of that object as data class
        if (!$class && isset($options['data']) && is_object($options['data'])) {
            $defaultOptions['data_class'] = $class = get_class($options['data']);
        }

        if ($class) {
            $defaultOptions['empty_data'] = function () use ($class) {
                return new $class();
            };
        } else {
            $defaultOptions['empty_data'] = '';
        }

        return $defaultOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function createBuilder($name, FormFactoryInterface $factory, array $options)
    {
        return new FormBuilder($name, $factory, new EventDispatcher(), $options['data_class']);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'field';
    }

    private function humanize($text)
    {
        return ucfirst(strtolower(str_replace('_', ' ', $text)));
    }
}
