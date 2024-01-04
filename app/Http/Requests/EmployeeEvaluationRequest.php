<?php

namespace App\Http\Requests;

use App\Models\ProgrammingLevelItem;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeEvaluationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|numeric',
            'programming_id' => 'required|numeric|exists:programming_languages,id',
            'programming_type' => 'required|numeric|in:' . ProgrammingLevelItem::TYPE_INVALID . ',' . ProgrammingLevelItem::TYPE_PROGRAMMING_LANGUAGE . ',' . ProgrammingLevelItem::TYPE_FRAMEWORK,
            'total_score' => 'required|numeric'
        ];
    }
}
