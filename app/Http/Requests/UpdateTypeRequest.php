<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
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
            'name' => 'required',
            'duration' => 'required',
            'time' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'duration.required' => 'Jumlah cuti wajib diisi',
            'time.required' => 'Harus memilih skala.'
        ];
    }
}
