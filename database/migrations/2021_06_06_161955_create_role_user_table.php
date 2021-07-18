<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('administrative_unit_id')->nullable();
            $table->unsignedBigInteger('spending_unit_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('administrative_unit_id')->references('id')->on('administrative_units')->onDelete('cascade');
            $table->foreign('spending_unit_id')->references('id')->on('spending_units')->onDelete('cascade');
            $table->integer('role_status')->default(1);
            $table->integer('administrative_unit_status')->default(0);
            $table->integer('spending_unit_status')->default(0);
            $table->integer('global_status')->default(1);
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
        Schema::dropIfExists('role_user');
    }
}
