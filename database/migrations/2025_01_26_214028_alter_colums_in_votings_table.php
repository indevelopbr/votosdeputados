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
        Schema::table('votings', function (Blueprint $table) {
            $table->string('voting_uri')->index();
            $table->boolean('main_vote')->default(false)->index();
            $table->string('image_url')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('votings', function (Blueprint $table) {
            $table->dropColumn('voting_uri');
            $table->dropColumn('main_vote');
            $table->dropColumn('image_url');
        });
    }
};
