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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voting_id')->index()->constrained('votings')->onDelete('cascade');
            $table->foreignId('senator_id')->index()->constrained('senators')->onDelete('cascade');
            $table->enum('vote', ['Y', 'N', 'I'])->index()->default('I');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['voting_id', 'senator_id']);
            $table->index(['voting_id', 'senator_id', 'vote']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
