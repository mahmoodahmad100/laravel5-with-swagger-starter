<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        switch ($this->method())  {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name'     => 'required|min:3|max:50',
                        'email'    => 'required|email',
                        'password' => 'required|min:5|max:20'
                    ];
                }
            case 'PUT': {
                    return [];
                }
            case 'PATCH': {
                    return [
                        'name'     => 'nullable|min:3|max:50',
                        'email'    => 'nullable|email',
                        'password' => 'nullable|min:5|max:20'
                    ];
                }
        }
    }
}