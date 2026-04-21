<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email','unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed']
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Trường :attribute là bắt buộc',
            'name.min' => 'Tên phải có ít nhất :min ký tự',
            'name.max' => 'Tên phải có ít nhất :max ký tự',

            'email.required' => 'Trường :attribute là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',

            'password.required' => 'Trường :attribute là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
            'password.max' => 'Mật khẩu phải có ít nhất :max ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ];
    }
}
