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

    public function ellipsize($str, $max_length, $position, $ellipsis)
    {
        // Strip tags
        $str = trim(strip_tags($str));

        // Is the string long enough to ellipsize?
        if (strlen($str) <= $max_length) {
            return $str;
        }

        $beg = substr($str, 0, floor($max_length * $position));

        $position = ($position > 1) ? 1 : $position;

        if ($position === 1) {
            $end = substr($str, 0, -($max_length - strlen($beg)));
        } else {
            $end = substr($str, -($max_length - strlen($beg)));
        }

        return $beg . $ellipsis . $end;
    }

}

