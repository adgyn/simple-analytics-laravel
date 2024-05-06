<?php

namespace Adgyn\SimpleAnalytics\Http\Requests;

use Adgyn\SimpleAnalytics\Services\IpService;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_name' => 'required|string|min:5',
            'event_label' => 'required|string|min:5',
            'route' => 'required|string',
        ];
    }

    /**
     * Prepare inputs for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $label = str_replace(' ', '_', $this->event_label);
        $label = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $label));
        $label = preg_replace('/[^a-zA-Z0-9_]/', '', $label);
        $this->merge([]);

        $countryData = IpService::getCountryData($this->ip());
        
        $this->merge([
            'event_label' => $label,
            'country' => $countryData->country,
            'country_code' => $countryData->code,
        ]);
    }
}
