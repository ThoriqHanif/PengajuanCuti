<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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
            'user_id' => 'required',
            'type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Harus terdapat user',
            'type_id.required' => 'Harus memilih tipe',
            'start_date.required' => 'Harus memilih tanggal mulai', 
            'end_date.required' => 'Harus memilih tanggal selesai', 
            'reason.required' => 'Harus mengisi Alasan Cuti', 
        ];
    }
}
