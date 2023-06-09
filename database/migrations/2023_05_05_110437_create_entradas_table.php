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
        Schema::create('entradas', function (Blueprint $table) {
          $table->id();
          $table->string('titulo', 30);
          $table->string('imagen', 100);
          $table->string('subtitulo', 60);
          $table->string('descripcion_breve', 120);
          $table->string('descripcion', 300);
          $table->date('fecha');
          $table->unsignedBigInteger('usuario_id');
          $table->unsignedInteger('categoria_id');
          $table->timestamps();

          $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
