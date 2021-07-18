<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->date('offerValidity');//valides de oferta
            $table->date('deliveryTime');//tiempo de entrega
            $table->date('answerDate');//fecha de respuesta
            $table->string('paymentMethod'); //metodo de pago
            $table->string('observation')->nullable();
            $table->foreignId('company_codes_id')->constrained();
            $table->foreignId('business_id')->constrained();
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
        Schema::dropIfExists('quotations');
    }
}
