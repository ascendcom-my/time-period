<?php

namespace Bigmom\TimePeriod\Services;

use Illuminate\Support\Facades\Cache;
use Bigmom\TimePeriod\Contracts\NamedTimePeriodResolver;
use Bigmom\TimePeriod\Exceptions\TimePeriodNotFoundException;
use Bigmom\TimePeriod\Models\TimePeriod;
use Carbon\CarbonPeriod;

class CacheOrDatabaseNamedTimePeriodResolver implements NamedTimePeriodResolver
{
    public function resolve(string $key): CarbonPeriod
    {
        /** @var TimePeriod|null $model */
        $timePeriod = Cache::rememberForever(self::resolveCacheKey($key), function () use ($key) {
            $model = TimePeriod::where('key', $key)->first();

            return is_null($model)
                ? null
                : new CarbonPeriod($model->start_at, $model->end_at);
        });

        if (is_null($timePeriod))
            throw new TimePeriodNotFoundException("Time period with key $key not found in database table 'time_periods'.");

        return $timePeriod;
    }

    public static function resolveCacheKey(string $key): string
    {
        return "named-time-period_$key";
    }
}
