<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
            'full_name' => 'required',
            'username' => 'required',
            'entry_date' => 'required',
            'telp' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            // 'division_id' => 'required',
            'position_id' => 'required',
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Nama Lengkap harus diisi',
            'username.required' => 'Nama Lengkap harus diisi',
            'entry_date.required' => 'Tanggal Masuk harus diisi',
            'telp.required' => 'Telephone harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah pernah digunakan',
            'email.email' => 'Email harus valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            // 'division_id.required' => 'Harus memilih Divisi',
            'position_id.required' => 'Harus memilih Posisi',
            'role_id.required' => 'Harus memilih Role',

        ];
        
    }
}
