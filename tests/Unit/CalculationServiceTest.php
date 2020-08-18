<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CalculationService;

class CalculationServiceTest extends TestCase
{

    /**
     * Unit test the calculate() function.
     *
     * @return void
     */
    public function testCalculate(): void
    {
        $calc_service = new CalculationService();
        $this->assertEquals(4, $calc_service->calculate('2+2'));
        $this->assertEquals(70, $calc_service->calculate('(5+9)*5'));
        $this->assertEquals(30.4, $calc_service->calculate('(10.2+0.5*(2-0.4))*2+(2.1*4)'));
    }

}
