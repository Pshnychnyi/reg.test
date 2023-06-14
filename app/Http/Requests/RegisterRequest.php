<?php

namespace App\Http\Requests;

use App\Services\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
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
            'name' => 'required|string|min:7|max:255',
            'surname' => 'required|string|min:7|max:255',
            'email' => 'required|email|min:7|max:255',
            'pass' => 'required|string|min:6|max:255|confirmed'
        ];
    }
}
