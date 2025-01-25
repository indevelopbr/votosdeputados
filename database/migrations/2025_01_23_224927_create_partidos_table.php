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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->string('sigla')->index();
            $table->string('nome')->nullable()->index();
            $table->string('logo')->nullable();
            $table->string('site')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('manual_logo')->nullable();
            $table->string('manual_site')->nullable();
            $table->string('manual_facebook')->nullable();
            $table->string('manual_instagram')->nullable();
            $table->string('manual_twitter')->nullable();
            $table->date('data_criacao')->nullable();
            $table->date('data_extincao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
