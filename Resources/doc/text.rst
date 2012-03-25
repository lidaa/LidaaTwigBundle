::

    highlight($text, $string, $color = "#990000", $tag = 'span')

Highlights a string within a text

::

    ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;')

This function will strip tags from a string, split it at its max_length and ellipsize



**Example:**


::

    {{ highlight("I love Symfony2 very much.", "Symfony2") }}

=> 

::

    I love <span style="color: #990000">Symfony2</span> very much. 

----------------------------------

::

    {{ ellipsize('I love Symfony2 very much.', 12, 0.5) }}

=> 

::

    I love… much.
