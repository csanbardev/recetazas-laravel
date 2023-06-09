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
        Schema::create('pasos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('secuencia', 150);
            $table->unsignedBigInteger('entrada_id');
            $table->integer('orden');
            $table->string('imagen', 200)->nullable();
            $table->timestamps();

          $table->foreign('entrada_id')->references('id')->on('entradas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasos');
    }
};
