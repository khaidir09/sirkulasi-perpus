<?php

namespace App\Http\Requests\Admin;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'role' => 'max:50|default:Anggota',
            'competencies_id' => [
                'exists:competencies,id'
            ],
            'class_rooms_id' => [
                'exists:class_rooms,id'
            ],
            'nomor_hp' => 'max:50',
            'alamat' => 'max:255',
            'tempat_lahir' => 'max:255',
            'tgl_lahir' => 'date',
            'nama_ibu' => 'required|max:100',
            'nomor_hp_ortu' => 'max:50',
        ];
    }
}
