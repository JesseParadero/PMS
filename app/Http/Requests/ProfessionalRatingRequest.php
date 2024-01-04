<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfessionalRatingRequest extends FormRequest
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
        $rtn = [
            'description' => 'required|max:50',
            'score' => ['required', 'numeric'],
        ];

        if ($this->isMethod('put')) {
            $rtn['score'][] = Rule::unique('professional_development_ratings', 'score')
                ->ignore($this->route('rating'));
        } else {
            $rtn['score'][] = Rule::unique('professional_development_ratings')->where(function ($query) {
                return $query->where('score', $this->input('score'));
            });
        }

        return $rtn;
    }
}
