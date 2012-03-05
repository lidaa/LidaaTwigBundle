<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

/**
 * NumberExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class NumberExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['to_percent'] = new \Twig_Function_Method($this, 'toPercent');
        $fonctions['to_readable_size'] = new \Twig_Function_Method($this, 'toReadableSize');

        return $fonctions;
    }

    public function toPercent($number)
    {
        $percent = number_format($number / 100, 2);

        if ($number % 100 == 0)
            $percent = (int) $percent;

        $percent = $percent . '%';

        return $percent;
    }

    public function toReadableSize($number, $type = 'o')
    {
        switch (strtolower($type)) {
            case 'k' : $number_readable = $number / 1024;
                break;
            case 'm' : $number_readable = $number / (1024 * 1024);
                break;
            case 'g' : $number_readable = $number / (1024 * 1024 * 1024);
                break;
            default : $number_readable = $number;
        }

        return $number_readable;
    }

    public function getName()
    {
        return 'number';
    }
}
