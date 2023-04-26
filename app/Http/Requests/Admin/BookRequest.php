<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'judul' => 'required|max:255',
            'nomor_induk' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'tahun_terbit' => 'required|max:255',
            'asal' => 'required|max:255',
            'harga' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'publishers_id' => [
                'exists:publishers,id'
            ],
            'classifications_id' => [
                'exists:classifications,id'
            ],
        ];
    }
}
