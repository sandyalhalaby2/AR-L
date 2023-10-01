<?php

namespace App\Http\Requests\Exercise;

use App\Http\Requests\ValidationFormRequest;

class StoreExerciseRequest extends ValidationFormRequest
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
    public function rules()
    {
        return [
            'lesson_id' => 'required|integer|exists:skills,id', // ensures the lesson_id exists in the skills table
            'type' => 'required|in:translation,listening,sentenceFormation,multipleChoice',
            'question' => 'required|string|max:255', // assuming max length of the string is 255
            'audioFilePath' => 'nullable|string|max:255', // assuming max length of the string is 255
        ];
    }

}
