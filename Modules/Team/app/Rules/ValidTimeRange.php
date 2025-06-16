<?php

namespace Modules\Team\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidTimeRange implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match('/availabilities\.(\d+)\.end_time/', $attribute, $matches);

        $index = $matches[1] ?? null;
        if ($index === null) {
            return; // skipping
        }

        $start = request("availabilities.$index.start_time");

        if ($start && $value && $start >= $value) {
            $fail(__('tenant.team.availability.end_time_after_start_time', [
                'index' => $index,
            ]));
        }
    }
}
