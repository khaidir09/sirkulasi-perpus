<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'users_id' => [
                'exists:users,id'
            ],
            'books_id' => [
                'exists:books,id'
            ],
            'status' => 'max:255',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
