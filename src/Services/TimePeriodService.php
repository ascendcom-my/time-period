<?php

namespace Bigmom\TimePeriod\Services;

use Bigmom\TimePeriod\Contracts\NamedTimePeriodResolver;
use Carbon\CarbonPeriod;

class TimePeriodService
{
    public function of(string $key): CarbonPeriod
    {
        /** @var NamedTimePeriodResolver $resolver */
        $resolver = app(NamedTimePeriodResolver::class);
        $timePeriod = $resolver->resolve($key);

        return $timePeriod;
    }

    public function __call($name, $arguments): mixed
    {
        $timePeriod = new CarbonPeriod();
        return $timePeriod->$name(...$arguments);
    }
}
