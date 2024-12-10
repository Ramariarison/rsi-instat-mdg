<?php

use App\Providers\RouteServiceProvider;

test('L\'écran d\'inscription peut être rendu', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('De nouveaux utilisateurs peuvent s\'inscrire', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
