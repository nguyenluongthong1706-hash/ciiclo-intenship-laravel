<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:255']
        ];
    }

    public function messages():array{
        return [
            'email.required' => 'Trường :attribute là bắt buộc',
            'email.email' => 'Email phải thuộc dạng email',

            'password.required' => 'Trường :attribute là bắt buộc',
            'password.string' => 'Password phải là chuỗi ký tự',
            'password.min' => 'Password phải ít nhất 8 ký tự',
            'password.max' => 'Password phải nhiều nhất 255 ký tự',
        ];
    }
}
