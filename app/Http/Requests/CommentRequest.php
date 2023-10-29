<?php

namespace App\Http\Requests;

use App\Enums\CommentEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class CommentRequest extends FormRequest
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
//        dd(Rule::in(array_column(CommentEnum::cases(),'value')));
        return [

            'comment'          => ['required','string'],
            'user_id' => 'exists:user',
//            'commentable_type' => 'required|in:product,blog',
//             commentable type read from enum file
            // khate zir check mikonad ke type haye voroodi faghat product ya blog bashad ke az file enum mikhanad.
            'commentable_type' => [new RequiredIf($this->isMethod('post') and $this->isMethod('patch'))
                                   ,Rule::in(array_column(CommentEnum::cases(),'value'))],

            'commentable_id'=>[new RequiredIf($this->isMethod('post')
                and $this->isMethod('patch')),'integer']
        ];
    }
}
