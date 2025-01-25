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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('acronym', 35)->nullable()->index();
            $table->string('image_logo')->nullable();
            $table->date('foundation_date')->nullable()->index();
            $table->date('extinction_date')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'acronym']);
            $table->index(['name', 'foundation_date']);
            $table->index(['name', 'extinction_date']);
            $table->index(['acronym', 'foundation_date']);
            $table->index(['acronym', 'extinction_date']);
            $table->index(['foundation_date', 'extinction_date']);
            $table->index(['name', 'acronym', 'foundation_date']);
            $table->index(['name', 'acronym', 'extinction_date']);
            $table->index(['name', 'foundation_date', 'extinction_date']);
            $table->index(['acronym', 'foundation_date', 'extinction_date']);
            $table->index(['name', 'acronym', 'foundation_date', 'extinction_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
