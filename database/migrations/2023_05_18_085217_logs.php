<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('logs', function (Blueprint $table) {
      $table->increments('id');
      $table->date('fecha');
      $table->time('hora');
      $table->string('operacion', 20);
      $table->string('usuario', 20);
      $table->timestamps();
    });

    $procedimiento = "
        CREATE PROCEDURE `insertarLog`(`fecha` DATE, `hora` TIME, `operacion` VARCHAR(20), `usuario` VARCHAR(20))
        BEGIN
            INSERT INTO logs (fecha, hora, operacion, usuario) VALUES (fecha, hora, operacion, usuario);
        END
        ";

    DB::unprepared($procedimiento);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
  }
};
