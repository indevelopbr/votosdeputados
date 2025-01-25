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
        Schema::create('votacoes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_votacao')->nullable()->index();
            $table->string('sigla_casa_colegiado', 10)->nullable()->index();
            $table->integer('codigo_reuniao')->nullable()->index();
            $table->dateTime('data_hora_inicio_reuniao')->nullable()->index();
            $table->integer('numero_reuniao_colegiado')->nullable()->index();
            $table->string('tipo_reuniao', 50)->nullable()->index();
            $table->integer('codigo_colegiado')->nullable()->index();
            $table->string('sigla_colegiado', 10)->nullable()->index();
            $table->string('nome_colegiado', 255)->nullable()->index();
            $table->integer('codigo_parlamentar_presidente')->nullable()->index();
            $table->string('nome_parlamentar_presidente', 255)->nullable()->index();
            $table->string('identificacao_materia', 100)->nullable()->index();
            $table->string('descricao_identificacao_materia', 255)->nullable()->index();
            $table->string('descricao_votacao', 255)->nullable()->index();
            $table->integer('total_votos_sim')->default(0);
            $table->integer('total_votos_nao')->default(0);
            $table->integer('total_votos_abstencao')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votacoes');
    }
};
