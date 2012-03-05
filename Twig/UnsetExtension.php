<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

use Lidaa\TwigBundle\Twig\TokenParser\UnsetTokenParser;

/**
 * UnsetExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class UnsetExtension extends \Twig_Extension
{
    public function getTokenParsers()
    {
        return array(
            new UnsetTokenParser(),
        );
    }

    public function getName()
    {
        return 'unset';
    }
}