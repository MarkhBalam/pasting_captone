<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'program_id'            => 'required|exists:programs,id',
            'title'                 => 'required|string|max:255',
            'nature_of_project'     => 'required|string|max:100',
            'description'           => 'nullable|string',
            'innovation_focus'      => 'nullable|string|max:100',
            'prototype_stage'       => 'nullable|string|max:100',
            'testing_requirements'  => 'nullable|string',
            'commercialization_plan'=> 'nullable|string',
            'facility_ids'          => 'nullable|array',
            'facility_ids.*'        => 'exists:facilities,id',
        ];
    }
}
