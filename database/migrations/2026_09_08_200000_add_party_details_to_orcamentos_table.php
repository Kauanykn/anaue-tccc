<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->string('aniversariante')->nullable()->after('email');
            $table->string('idade')->nullable()->after('aniversariante');
            $table->string('pacote')->nullable()->after('quantidade_convidados');
            $table->text('observacoes')->nullable()->after('pacote');
        });
    }

    public function down(): void
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->dropColumn(['aniversariante', 'idade', 'pacote', 'observacoes']);
        });
    }
};
