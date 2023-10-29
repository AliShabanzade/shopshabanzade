<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
        return [
            'uuid'          => ['required'],
            'user_id'       => ['nullable', 'exists:users'],
            'mediable_id'   => ['required', 'integer'],
            'mediable_type' => ['required'],
            'url'           => ['required'],
            'extension'     => ['nullable'],
            'size'          => ['nullable'],

        ];
    }
}
