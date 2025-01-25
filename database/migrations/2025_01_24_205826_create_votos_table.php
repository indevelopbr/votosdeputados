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
        Schema::create('votos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('votacao_id')->constrained('votacoes');
            $table->foreignId('senador_id')->nullable()->index();
            $table->string('partido_id')->constrained('partidos');
            $table->string('sigla_casa_parlamentar')->nullable()->index();
            $table->string('qualidade_voto', 4)->nullable()->index();
            $table->boolean('voto_presidente')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votos');
    }
};
