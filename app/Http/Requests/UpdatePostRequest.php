<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'content'=> ['required', 'string', 'min:3'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ];
    }

    public function messages(): array{
        return [
            'title.required' => 'Trường :attribute là bắt buộc',
            'title.min' => 'Tiêu đề phải có ít nhất :min ký tự',
            'title.max' => 'Tiêu đề phải có nhiều nhất :max ký tự',

            'content.required' => 'Trường :attribute là bắt buộc',
            'content.min' => 'Nội dung phải có ít nhất :min ký tự',
            'content.max' => 'Nội dung phải có nhiều nhất :max ký tự',

            'category_id.exists' => 'Danh mục không tồn tại',
        ];
    }
}
