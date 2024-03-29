<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactPostRequest extends FormRequest
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
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'inquiry' => 'required',
            'message' => 'required|min:15',
        ];
    }
    
    public function messages()
    {
        return [
            'first_name.required' => 'Please provide your name.',
            'last_name.required' => 'Please provide your surname.',
            'email.required' => 'Please provide a valid email address.',
            'inquiry.required' => 'Please include an inquiry type.',
            'message.required' => 'Please describe your reason for contacting us.',
            'message.min' => 'Please include a longer, more descriptive message.',
        ];
    }
}
