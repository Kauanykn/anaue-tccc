<?php

namespace Tests\Feature;

use App\Models\Orcamento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientBudgetsTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_only_see_their_own_budgets(): void
    {
        $client = User::factory()->create();
        $anotherClient = User::factory()->create();

        $clientBudget = Orcamento::create([
            'user_id' => $client->id,
            'nome' => 'Ana Silva',
            'telefone' => '11999999999',
            'data_evento' => '2026-10-10',
            'aniversariante' => 'Julia',
            'status' => 'pendente',
        ]);

        $anotherClientBudget = Orcamento::create([
            'user_id' => $anotherClient->id,
            'nome' => 'Maria Souza',
            'telefone' => '11888888888',
            'data_evento' => '2026-10-11',
            'aniversariante' => 'Pedro',
            'status' => 'aprovado',
        ]);

        $response = $this->actingAs($client)->get(route('cliente.orcamentos'));

        $response->assertOk();
        $response->assertSee('ORÇAMENTO #' . str_pad((string) $clientBudget->id, 4, '0', STR_PAD_LEFT));
        $response->assertSee('Festa de Julia');
        $response->assertDontSee('ORÇAMENTO #' . str_pad((string) $anotherClientBudget->id, 4, '0', STR_PAD_LEFT));
        $response->assertDontSee('Festa de Pedro');
    }

    public function test_guest_is_redirected_from_client_budgets(): void
    {
        $this->get(route('cliente.orcamentos'))
            ->assertRedirect(route('login'));
    }
}
