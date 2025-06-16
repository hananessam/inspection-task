<?php

namespace Modules\Team\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Team\Enums\DayOfWeekEnum;
use Illuminate\Validation\Rule;
use Modules\Team\Rules\ValidTimeRange;

class CreateTeamAvailabilityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'availabilities' => 'required|array',
            'availabilities.*.day_of_week' => [
                'required',
                Rule::in(DayOfWeekEnum::cases()),
            ],
            'availabilities.*.start_time' => 'required|date_format:H:i',
            'availabilities.*.end_time' => [
                'required',
                'date_format:H:i',
                new ValidTimeRange(),
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
