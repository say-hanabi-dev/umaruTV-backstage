<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnimeRequest extends FormRequest
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
            'name'=>'required|max:100',
            'introduction'=>'required',
            'release_time'=>'date',
            'cover_file'=>'image',
            'status'=>['required',Rule::in(['updating','end','stop'])]
        ];
    }

    function saveCover(){
        $time = date('Y/m');
        if ($this->hasFile('cover_file')){
            $rst =  $this->file('cover_file')->store('cover'.$time, 'public');
            $this->merge(['cover'=> setting('upload_domain').'/storage/'.$rst]);
        }
    }
}
