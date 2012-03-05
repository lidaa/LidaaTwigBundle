<?php

/*
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Crumbs;

/**
 * Crumbs
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class Crumbs implements \ArrayAccess, \Countable, \Iterator
{

    private $items;
    private $separator;

    public function __construct()
    {
        $this->items = array();
        $this->separator = '&raquo;';
    }

    public function addItem($title, $routeName, $routeParameters = array())
    {
        $this->items[] = array($title, $routeName, $routeParameters);

        return $this;
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);

        return $this;
    }

    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }

    public function getSeparator()
    {
        return $this->separator;
    }

    public function offsetExists($index)
    {
        return isset($this->items[$index]);
    }

    public function offsetGet($index)
    {
        return $this->items[$index];
    }

    public function offsetSet($index, $value)
    {
        if (is_array($value))
            $this->items[$index] = $value;
    }

    public function offsetUnset($index)
    {
        $this->removeItem($index);
    }

    public function count()
    {
        return count($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function valid()
    {
        return key($this->items) !== null;
    }

    public function rewind()
    {
        return reset($this->items);
    }

    public function isLast()
    {
        if ($this->current() === $this->items[$this->count() - 1]) {
            return true;
        }
        
        return false;
    }

}