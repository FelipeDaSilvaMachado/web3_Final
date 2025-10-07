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
        Schema::create('automoveis', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('marca', 100);
            $table->string('modelo', 100);
            $table->date('ano',10);
            $table->string('cor',20);
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automoveis');
    }
};
