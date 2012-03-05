<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\TokenParser;

use Lidaa\TwigBundle\Node\UnsetNode;

/**
 * UnsetTokenParser
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class UnsetTokenParser extends \Twig_TokenParser
{
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();

        $name = null;
        $expr = null;
        $stream = $this->parser->getStream();

        if (!$stream->test(\Twig_Token::BLOCK_END_TYPE)) {
            $expr = $this->parser->getExpressionParser()->parseExpression();
        }

        if ($expr instanceof \Twig_Node_Expression_Name) {
            $name = $expr->getAttribute('name');
        }

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new UnsetNode($name, $expr, $lineno, $this->getTag());
    }

    public function getTag()
    {
        return 'unset';
    }
}
