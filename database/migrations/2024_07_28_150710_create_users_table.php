<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('s_name');
                $table->string('p_name');
                $table->string('email')->unique();
                $table->string('phone')->unique();
                $table->string('address');
                $table->string('country');
                $table->string('state');
                $table->string('city');
                $table->string('lga');
                $table->unsignedBigInteger('school_id');
                $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}