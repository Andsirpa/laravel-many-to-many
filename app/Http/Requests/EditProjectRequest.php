<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'description' => 'string|nullable',
            'project_link' => 'required|url',
            'type_id' => 'nullable|exists:types,id'
        ];
    }

    /**
     * Get the error message.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => "Title must be a string",
            'title.max' => 'Max lenght 100 char',
            'author.required' => "Author is required",
            'author.string' => "Author must be a string",
            'author.max' => 'Max lenght 100 char',
            'description.string' => "Description mast be a string",
            'project_link.required' => "Link is required",
            'project_link.url' => "Link must be a valid URL"
        ];
    }
}