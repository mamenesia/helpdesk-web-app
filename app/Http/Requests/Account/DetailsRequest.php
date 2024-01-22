<?php

namespace App\Http\Requests\Account;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class DetailsRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'nomor_hp' => ['required', 'numeric', 'max:255', 'unique:users,nomor_hp,' . Auth::user()->id],
            'avatar' => ['image', 'max:1000', 'dimensions:ratio=1/1']
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
            'name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
            'name.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('name'), 'max' => 255]),

            'nomor_hp.required' => __('The :attribute field is required', ['attribute' => __('nomor_hp')]),
            'nomor_hp.numeric' => __('The :attribute must be a number', ['attribute' => __('nomor_hp')]),
            'nomor_hp.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('nomor_hp'), 'max' => 12]),
            'nomor_hp.unique' => __('The :attribute has already been taken', ['attribute' => __('nomor_hp')]),

            'avatar.image' => __('The file has to be an image', ['attribute' => __('avatar')]),
            'avatar.max' => __('The :attribute may not be greater than :max kilobytes', ['attribute' => __('avatar'), 'max' => 1000]),
            'avatar.dimensions' => __('The :attribute has invalid image dimensions', ['attribute' => __('avatar')])
        ];
    }
}
