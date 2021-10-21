<?php

namespace Bigmom\TimePeriod\Contracts;

use Carbon\CarbonPeriod;

interface NamedTimePeriodResolver
{
    public function resolve(string $key): CarbonPeriod;
}
