<?php

namespace App\Http\Requests\Backstage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $this->uniqueUser()],
            'password' => ['string', 'min:8', 'confirmed'],
        ];
    }

    public function uniqueUser(){
        return Rule::unique('users')->ignore(
            Route::current()->parameter('user')
        );
    }
}
