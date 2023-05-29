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
          $table->string('titulo', 20);
          $table->string('imagen', 100);
          $table->string('descripcion', 300);
          $table->date('fecha');
          $table->unsignedBigInteger('usuario_id');
          $table->unsignedInteger('categoria_id');
          $table->unsignedInteger('pasos_id');
          $table->timestamps();

          $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('categoria_id')->references('id')->on('categorias');
          $table->foreign('pasos_id')->references('id')->on('pasos');
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
