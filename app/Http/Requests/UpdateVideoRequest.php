<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
            'name' => 'required|max:255',
            'cover' => 'mimes:jpeg,jpg,png|max:5000',
            'link' => 'mimes:mp4,webm,ogv,avi,flv,m4v,mkv,mpeg|max:100000   ',
        ];
    }
}
