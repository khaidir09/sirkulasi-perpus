<?php

namespace App\Http\Requests;

use App\Models\Wishlist;
use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends FormRequest
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
            'judul_buku' => 'required|max:255',
            'penerbit' => 'required|max:100',
            'status' => 'max:100',
        ];
    }
}
