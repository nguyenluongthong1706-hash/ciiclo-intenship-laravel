<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UploadAvatarRequest extends FormRequest
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
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }

    public function messages(): array {
        return [
            'avatar.required' => 'Trường :attribute là bắt buộc',
            'avatar.image' => 'Avatar phải là hình ảnh',
            'avatar.mimes' => 'Avatar phải có định dạng jpg, jpeg hoặc png',
            'avatar.max' => 'Avatar không được vượt quá :max KB'
        ];
    }
}
