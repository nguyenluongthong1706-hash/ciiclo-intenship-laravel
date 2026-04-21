<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'min:3','max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array{
        return [
            'name.string' => 'Tên phải là chuỗi ký tự',
            'name.min' => 'Tên phải có ít nhất :min ký tự',
            'name.max' => 'Tên phải có nhiều nhất :max ký tự',

            'avatar.image' => 'Avatar phải là hình ảnh',
            'avatar.mimes' => 'Avatar phải có định dạng jpg, jpeg hoặc png',
            'avatar.max' => 'Avatar không được vượt quá :max KB',
        ];
    }
}
