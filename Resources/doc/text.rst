Highlights
=====

Highlights a string within a text

::

    highlight($text, $string, $color = "#990000", $tag = 'span')

**Example:**

::

    {{ highlight("I love Symfony2 very much.", "Symfony2") }}

**Result:**

::

    I love <span style="color: #990000">Symfony2</span> very much. 

Ellipsize
====

This function will strip tags from a string, split it at its max_length and ellipsize

::

    ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;')

**Example:**

::

    {{ ellipsize('I love Symfony2 very much.', 12, 0.5) }}

**Result:**

::

    I love… much.
