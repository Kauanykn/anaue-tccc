<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pacotes', function (Blueprint $table) {
        $table->id();

        $table->string('nome');
        $table->text('descricao');
        $table->integer('duracao');

        $table->boolean('decoracao_inclusa')->default(false);

        $table->string('imagem');

        $table->longText('cardapio');

        $table->decimal('preco_semana_30', 10, 2);
        $table->decimal('preco_semana_50', 10, 2);

        $table->decimal('preco_fim_semana_30', 10, 2);
        $table->decimal('preco_fim_semana_50', 10, 2);

        $table->decimal('valor_excedente', 10, 2);

        $table->integer('parcelas')->default(8);

        $table->boolean('ativo')->default(true);

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacotes');
    }
};
