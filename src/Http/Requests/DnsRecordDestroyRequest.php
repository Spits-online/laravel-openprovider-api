<?php

namespace Spits\LaravelOpenproviderApi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spits\LaravelOpenproviderApi\Enums\DnsRecordTypes;

class DnsRecordDestroyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'provider' => ['nullable', 'string'],
            'records.*.name' => ['nullable', 'string'],
            'records.*.type' => ['required', 'string', Rule::in(DnsRecordTypes::cases())],
            'records.*.prio' => ['nullable', 'numeric', Rule::requiredIf(fn () => $this->input('type') === DnsRecordTypes::MX->value)],
            'records.*.ttl' => ['required'],
            'records.*.value' => ['required', 'string'],
        ];
    }
}
