<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLimiteAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limite_amounts', function (Blueprint $table) {
            $table->id();
            $table->integer('monto');
            $table->date('starDate'); //fecha inicio
            $table->date('endDate')->nullable(); //fecha fin
            $table->year('steps');   //gestiones
            $table->foreignId('administrative_units_id')->nullable()->constrained();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('limite_amounts');
    }
}
