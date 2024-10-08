<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rule = '';
        if ($this->isMethod('post')) {
            $rule = 'required';
        }
        return [
            'title' => ['required','min:3'],
            'body' => ['required','min:10'],
            'category_id' => ['required','exists:categories,id'],
            'meta_description' => ['required','min:10'],
            'thumbnail' => [$rule,'image','mimes:png,jpg','extensions:jpg,png'],
        ];
    }
}
