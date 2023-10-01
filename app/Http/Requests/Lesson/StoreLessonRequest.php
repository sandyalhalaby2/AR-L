<?php

namespace App\Http\Requests\Lesson;

use App\Http\Requests\ValidationFormRequest;

class StoreLessonRequest extends ValidationFormRequest
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
            'name' => 'required|string|max:50', // assuming max length of the string is 255
            'course_id' => 'required|integer|exists:levels,id', // ensures the course_id exists in the levels table
            'content' => 'Required|string',
            'permission' => 'required|in:guest,normal,verified,permission',
        ];
    }
}
