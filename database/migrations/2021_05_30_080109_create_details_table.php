<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->integer('unitPrice'); //precion unitario
            $table->integer('totalPrice');//precio total
            $table->string('brand')->nullable();
            $table->string('industry')->nullable();
            $table->string('model')->nullable();
            $table->string('warrantyTime')->nullable();
            $table->foreignId('request_details_id')->constrained();
            $table->foreignId('quotations_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('details');
    }
}
