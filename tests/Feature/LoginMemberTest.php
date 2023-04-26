<?php

test('mengarahkan ke halaman dashboard jika menggunakan akun yang memiliki role Anggota', function () {

    $response = $this->post('/login', [
        'email' => 'hpuspasari@gmail.com',
        'password' => 'password',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect('/dashboard');
});
