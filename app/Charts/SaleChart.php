<?php

declare(strict_types = 1);

namespace App\Charts;

use ConsoleTVs\Charts\BaseChart;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;

class SaleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        
        return Chartisan::build()
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
            ->dataset('Sales', [12, 5, 34, 41, 25, 6, 71, 44, 92, 101, 11, 125])
            ->dataset('Oder', [10, 25, 31, 11, 7, 66, 70, 81, 32, 10, 75, 110])
            ->dataset('User', []);
        }
}