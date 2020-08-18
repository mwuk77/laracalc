<?php

namespace App\Services;

use MathParser\StdMathParser;
use MathParser\Interpreting\Evaluator;

/**
 * Service to provide basic calculator functionality.
 * 
 * Uses https://packagist.org/packages/mossadal/math-parser
 * 
 */
class CalculationService
{

    private $parser;
    private $evaluator;

    public function __construct()
    {
        $this->parser    = new StdMathParser();
        $this->evaluator = new Evaluator();
    }

    public function calculate($input)
    {
        // Generate an abstract syntax tree
        $AST = $this->parser->parse($input);

        // Do something with the AST, e.g. evaluate the expression:
        $value = $AST->accept($this->evaluator);
        return $value;
    }

}
