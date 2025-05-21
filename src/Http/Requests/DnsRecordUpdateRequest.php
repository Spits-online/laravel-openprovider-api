<?php

namespace Spits\LaravelOpenproviderApi\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Spits\LaravelOpenproviderApi\Enums\DnsRecordTypes;

class DnsRecordUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'provider' => ['nullable', 'string'],
            'original_record.name' => ['nullable', 'string'],
            'original_record.type' => ['required', 'string', Rule::in(DnsRecordTypes::cases())],
            'original_record.ttl' => ['required'],
            'original_record.prio' => ['nullable', 'numeric', Rule::requiredIf(fn () => $this->input('type') === DnsRecordTypes::MX->value)],
            'original_record.value' => ['required', 'string'],

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
            'record.ttl' => trans('validation.attributes.ttl'),
            'record.prio' => trans('validation.attributes.priority'),
            'record.value' => trans('validation.attributes.content'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors()->toArray())
            ->mapWithKeys(function ($messages, $key) {
                if (str_starts_with($key, 'record.')) {
                    $key = str_replace('record.', '', $key);
                }

                return [$key => $messages[0]];
            })
            ->toArray();

        throw new HttpResponseException(response()->json($errors, 422));
    }
}
