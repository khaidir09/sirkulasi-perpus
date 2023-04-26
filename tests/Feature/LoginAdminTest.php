<?php

test('mengarahkan ke halaman admin/dashoard jika menggunakan akun yang memiliki role Admin', function () {

    $response = $this->post('/login', [
        'email' => 'ewi@smkn1amuntai.sch.id',
        'password' => 'password',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect('admin/dashboard');
});
