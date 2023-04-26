<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'nomor_hp' => ['required', 'string', 'max:255'],
            'alamat' => ['required'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'nama_ibu' => ['required', 'string', 'max:255'],
            'nomor_hp_ortu' => ['required', 'string', 'max:255'],
            'perjanjian' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date'],
            'competencies_id' => [
                'required',
                'exists:competencies,id'
            ],
            'class_rooms_id' => [
                'required',
                'exists:class_rooms,id'
            ],
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nomor_hp' => $input['nomor_hp'],
            'alamat' => $input['alamat'],
            'tempat_lahir' => $input['tempat_lahir'],
            'nama_ibu' => $input['nama_ibu'],
            'nomor_hp_ortu' => $input['nomor_hp_ortu'],
            'perjanjian' => $input['perjanjian'],
            'tgl_lahir' => $input['tgl_lahir'],
            'competencies_id' => $input['competencies_id'],
            'class_rooms_id' => $input['class_rooms_id'],
        ]);
    }
}
