<?php

namespace Lidaa\TwigBundle\Twig\Node;

class UnsetNode extends \Twig_Node
{
	private $varName = '';
	
    public function __construct($name, \Twig_Node_Expression $expr = null, $lineno, $tag = null)
    {
		parent::__construct(array('value' => $expr), array('name' => $name), $lineno, $tag);
    }

    public function compile(\Twig_Compiler $compiler)
    {
    	if($this->getAttribute('name')) {
    		$this->varName = '[\''.$this->getAttribute('name').'\']';
    	}
    	else {
    		$node = $this->getNode('value');
    		$this->setVarName($node);
    	}
    	
    	$compiler
    	->write('unset($context'.$this->getVarName().');');
    }
    
    public function setVarName(\Twig_Node_Expression_GetAttr $node) 
    { 
    	foreach($node as $key => $value) {
    		if($value instanceof \Twig_Node_Expression_GetAttr) {
    			$this->setVarName($value);
    		}
    		if($value instanceof \Twig_Node_Expression_Name) {
    			$this->varName .= '[\''.$value->getAttribute('name').'\']';
    		}
    		if($value instanceof \Twig_Node_Expression_Constant) {
    			$this->varName .= '[\''.$value->getAttribute('value').'\']';
    		}
    	}
    }
    
    public function getVarName() {
    	return $this->varName;
    }
    
}
