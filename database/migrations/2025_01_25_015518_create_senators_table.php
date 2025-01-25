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
        Schema::dropIfExists('senadores');
        Schema::dropIfExists('partidos');

        Schema::create('senators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->string('uf', 2)->nullable()->index();
            $table->string('image_profile')->nullable()->index();
            $table->string('facebook')->nullable()->index();
            $table->string('instagram')->nullable()->index();
            $table->string('twitter')->nullable()->index();
            $table->string('site')->nullable()->index();
            $table->date('birth_date')->nullable()->index();
            $table->date('re_election')->nullable()->index();
            $table->foreignId('party_id')->constrained('parties')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senators');
    }
};
