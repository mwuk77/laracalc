<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalculationService;

class OperationController extends Controller
{

    private $calcService;

    public function __construct()
    {
        $this->calcService = new CalculationService();
    }

    /**
     * Execute expression and return result.
     *
     * @param \Illuminate\Http\Request  $request
     * 
     * Returns a string with either a float or int of the result.
     * 
     * @return string|null
     */
    public function execute(Request $request)
    {
        return $this->calcService->calculate(
            $this->parse($request)
        );
    }

    /**
     * Parse request and return expression.
     *
     * @param \Illuminate\Http\Request  $request
     * 
     * Returns a string with the expression.
     * 
     * @return string|null
     */
    private function parse(Request $request)
    {
        return $request->input('expression');
    }

}
