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
        Schema::create('senadores', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_publico_na_leg_atual')->nullable()->index();
            $table->string('nome')->nullable()->index();
            $table->string('nome_completo')->nullable()->index();
            $table->string('sexo')->nullable()->index();
            $table->string('forma_tratamento')->nullable()->index();
            $table->string('url_foto')->nullable()->index();
            $table->string('url_pagina')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('telefone')->nullable()->index();
            $table->string('facebook')->nullable()->index();
            $table->string('twitter')->nullable()->index();
            $table->string('instagram')->nullable()->index();
            $table->foreignId('partido_id')->nullable()->constrained('partidos');
            $table->string('uf')->nullable()->index();
            $table->boolean('membro_mesa')->default(false)->index();
            $table->boolean('membro_lideranca')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senadores');
    }
};
