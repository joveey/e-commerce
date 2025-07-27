<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            
            // Aturan untuk field baru
            'phone_number' => ['nullable', 'numeric', 'digits_between:10,15', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'address' => ['nullable', 'string'],
        ];
    }
}