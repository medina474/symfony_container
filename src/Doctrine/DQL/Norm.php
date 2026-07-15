<?php

namespace App\Doctrine\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\TokenType;
use Doctrine\ORM\Query\AST\Node;

final class Norm extends FunctionNode
{
    private Node $firstExpression;

    public function parse(Parser $parser): void
    {
        $parser->match(TokenType::T_IDENTIFIER);

        $parser->match(TokenType::T_OPEN_PARENTHESIS);

        $this->firstExpression = $parser->StringPrimary();

        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return sprintf(
            'norm(%s)',
            $this->firstExpression->dispatch($sqlWalker),
        );
    }
}
