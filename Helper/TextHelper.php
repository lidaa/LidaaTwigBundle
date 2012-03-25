<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\Locale\Stub\StubNumberFormatter;

/**
 * TextHelper
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class TextHelper
{
    public function highlight($haystack, $string, $color, $tag)
    {    	
        $highlight_str = sprintf('<%s style="color: %s">%s</%s>', $tag, $color, $string, $tag);
    	
        $haystack = str_replace($string, $highlight_str, $haystack);
    	
    	return $haystack;
    }
}

