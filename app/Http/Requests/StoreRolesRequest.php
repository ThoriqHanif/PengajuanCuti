<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolesRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
            'permissions' => 'required_without_all',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama role harus diisi',
            'name.unique' => 'Nama role sudah ada',
            'permissions.required_without_all' => 'Minimal harus memilih 1 hak akses',
        ];
    }
}
