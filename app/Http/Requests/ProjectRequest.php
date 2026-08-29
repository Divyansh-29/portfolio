<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('project') ? $this->route('project')->id : null;

        return [
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200', 'unique:projects,slug,' . $projectId],
            'subtitle' => ['nullable', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'tags' => ['nullable'],
            'category' => ['nullable', 'string', 'max:100'],
            'period' => ['nullable', 'string', 'max:100'],
            'role_type' => ['nullable', 'string', 'max:100'],
            'link' => ['nullable', 'string', 'max:255'],
            'repo_link' => ['nullable', 'string', 'max:255'],
            'art_type' => ['required', 'string', 'in:tax,bhoomi,core,custom'],
            'art_headline' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }
}

