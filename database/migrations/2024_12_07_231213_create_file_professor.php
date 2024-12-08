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
        Schema::create('file_professor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professor_id')->index();
            $table->foreignId('file_id')->index();
            $table->boolean("visualizado")->default(false);
            $table->boolean("confirmado")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_professor');
    }
};
