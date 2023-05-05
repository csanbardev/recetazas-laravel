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
        Schema::create('usuarios', function (Blueprint $table) {
          $table->increments('id');
          $table->string('rol', 6);
          $table->string('nick', 15);
          $table->string('nombre', 15);
          $table->string('apellidos', 20);
          $table->string('email', 15);
          $table->string('password', 40);
          $table->string('imagen-avatar', 20);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
