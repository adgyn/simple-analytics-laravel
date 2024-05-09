<?php

namespace Adgyn\SimpleAnalytics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
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
            'start_at' => 'date_format:Y-m-d H:i:s',
            'finish_at' => 'date_format:Y-m-d H:i:s',
            'detailed' => 'boolean',
            'routes' => 'array',
            'routes.*' => 'string',
            'reference' => 'array',
            'reference.*' => 'string',
            'countries' => 'array',
            'countries.*' => 'string',
        ];
    }

    /**
     * Prepare inputs for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->has('detailed')) {
            $this->merge([
                'detailed' => filter_var($this->detailed, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
    }
}
