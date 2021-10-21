<?php

namespace Bigmom\TimePeriod\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Carbon\CarbonPeriod of(string $key)
 * 
 * @see \Bigmom\TimePeriod\Services\TimePeriodService
 * @see \Carbon\CarbonPeriod
 */
class TimePeriod extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'time-period';
    }
}
