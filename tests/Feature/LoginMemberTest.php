<?php

test('mengarahkan ke halaman dashboard jika menggunakan akun yang memiliki role Anggota', function () {

    $response = $this->post('/login', [
        'email' => 'aisyah@gmail.com',
        'password' => '12345678',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect('/dashboard');
});
