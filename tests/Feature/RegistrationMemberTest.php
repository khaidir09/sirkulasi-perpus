<?php

test('menguji pembuatan akun/pendaftaran anggota oleh siswa', function () {
    $response = $this->post('/register', [
        'name' => 'Aisyah',
        'email' => 'aisyah@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'class_rooms_id' => '3',
        'competencies_id' => '1',
        'nomor_hp' => '08115001509',
        'alamat' => 'Jl. Negara Dipa RT.5',
        'tempat_lahir' => 'Amuntai',
        'tgl_lahir' => '2005/05/10',
        'nama_ibu' => 'Aminah',
        'nomor_hp_ortu' => '081252269339',
        'perjanjian' => 'Bersedia Menerima Perjanjian',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect('/dashboard');

    $this->assertDatabaseHas('users', [
        'name' => 'Aisyah',
        'email' => 'aisyah@gmail.com'
    ]);
});
