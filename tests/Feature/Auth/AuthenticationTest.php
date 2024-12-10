<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

test('L\'écran de connexion peut être rendu', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('Les utilisateurs peuvent s\'authentifier en utilisant l\'écran de connexion', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('Les utilisateurs ne peuvent pas s\'authentifier avec un mot de passe invalide', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('Les utilisateurs peuvent se déconnecter', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
