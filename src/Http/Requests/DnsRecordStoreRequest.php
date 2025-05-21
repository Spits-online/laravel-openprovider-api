<?php

namespace Spits\LaravelOpenproviderApi\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Spits\LaravelOpenproviderApi\Enums\DnsRecordTypes;

class DnsRecordStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'provider' => ['nullable', 'string'],
            'record.name' => ['nullable', 'string'],
            'record.type' => ['required', 'string', Rule::in(DnsRecordTypes::cases())],
            'record.prio' => ['nullable', 'numeric', Rule::requiredIf(fn () => $this->input('type') === DnsRecordTypes::MX->value)],
            'record.ttl' => ['required'],
            'record.value' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'record.name' => trans('validation.attributes.name'),
            'record.type' => trans('validation.attributes.dns_record_type'),
            'record.prio' => trans('validation.attributes.priority'),
            'record.ttl' => 'ttl',
            'record.value' => trans('validation.attributes.value'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        // Return the first error message for each field
        $errors = collect($validator->errors()->toArray())
            ->map(fn ($messages) => $messages[0])
            ->toArray();

        throw new HttpResponseException(response()->json($errors, 422));
    }
}
