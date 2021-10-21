<?php

namespace Bigmom\TimePeriod\Actions;

use Illuminate\Support\Facades\Cache;
use Bigmom\TimePeriod\Models\TimePeriod;
use Bigmom\TimePeriod\Services\CacheOrDatabaseNamedTimePeriodResolver;
use Carbon\CarbonPeriod;

/*
| This action should only be used if you are using the default resolver.
*/
class UpdateNamedTimePeriod
{
    public function __invoke(string $key, string|null $startAt, string|null $endAt)
    {
        TimePeriod::updateOrCreate(['key' => $key], [
            'start_at' => $startAt,
            'end_at' => $endAt,
        ]);

        $timePeriod = new CarbonPeriod($startAt, $endAt);

        Cache::put(CacheOrDatabaseNamedTimePeriodResolver::resolveCacheKey($key), $timePeriod);

        return $timePeriod;
    }
}
