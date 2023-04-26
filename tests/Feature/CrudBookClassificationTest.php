<?php

use App\Models\Classification;

test('menguji fungsi tambah data klasifikasi buku', function () {

    $data = [
        'name' => 'Pengetahuan Praktis',
        'kode' => '600',
    ];

    $response = $this->post('/klasifikasi', $data);

    $response->assertStatus(302);
    $response->assertRedirect('/klasifikasi');

    $this->assertDatabaseHas('classifications', $data);
});

test('menguji fungsi edit data klasifikasi buku', function () {

    $classification = Classification::findOrFail(1);

    // Send a PUT request to update the user's email
    $response = $this->put('/klasifikasi/' . $classification->id, [
        'name' => 'Ilmu Terapan',
        'kode' => '600-699',
    ]);

    // Check that the response status code is 302 (redirect)
    $response->assertStatus(302);

    // Check that the user was redirected to the expected page
    $response->assertRedirect('/klasifikasi');

    // Check that the user's email was updated in the database
    $this->assertDatabaseHas('classifications', [
        'id' => $classification->id,
        'name' => 'Ilmu Terapan',
        'kode' => '600-699',
    ]);
});

test('menguji fungsi hapus data klasifikasi buku', function () {
    $classification = Classification::findOrFail(1);

    $response = $this->delete('/klasifikasi/' . $classification->id);

    $response->assertStatus(302);
    $response->assertRedirect('/klasifikasi');

    $this->assertDatabaseMissing('classifications', ['id' => $classification->id]);
});
