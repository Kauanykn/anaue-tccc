<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationPhoneValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_rejects_phone_numbers_with_non_numeric_characters(): void
    {
        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => 'Ana Silva',
            'email' => 'ana@example.com',
            'telefone' => '1198765-4321',
            'password' => 'senha-segura',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('telefone');
        $this->assertDatabaseCount('users', 0);
    }

    public function test_registration_rejects_an_already_registered_phone_number(): void
    {
        User::factory()->create(['telefone' => '11987654321']);

        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => 'Ana Silva',
            'email' => 'ana@example.com',
            'telefone' => '11987654321',
            'password' => 'senha-segura',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('telefone');
        $this->assertDatabaseCount('users', 1);
    }
}
