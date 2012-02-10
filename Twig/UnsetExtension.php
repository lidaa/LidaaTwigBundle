<?php

namespace Lidaa\TwigBundle\Twig;

use Lidaa\TwigBundle\Twig\TokenParser\UnsetTokenParser;

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