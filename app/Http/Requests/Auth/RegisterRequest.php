<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nama' => ['required', 'max:255'],
            'nipp' => ['required', 'max:255', 'unique:users'],
            'nomor_hp' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama.required' => __('The :attribute field is required', ['attribute' => __('nama')]),
            'nama.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('nama'), 'max' => 255]),

            'nipp.unique' => __('The :attribute has already been taken', ['attribute' => __('nipp')]),

            'nomor_hp.required' => __('The :attribute field is required', ['attribute' => __('nomor_hp')]),
            'nomor_hp.numeric' => __('The :attribute must be a number', ['attribute' => __('nomor_hp')]),
            'nomor_hp.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('nomor_hp'), 'max' => 12]),
            'nomor_hp.unique' => __('The :attribute has already been taken', ['attribute' => __('nomor_hp')]),

            'password.required' => __('The :attribute field is required', ['attribute' => __('password')]),
            'password.min' => __('The :attribute must be at least :min characters', ['attribute' => __('password'), 'min' => 6]),
            'password.confirmed' => __('The :attribute confirmation does not match', ['attribute' => __('password')])
        ];
    }
}
