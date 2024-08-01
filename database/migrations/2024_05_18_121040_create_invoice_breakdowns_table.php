<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceBreakdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_breakdowns', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('student_id');
            $table->integer('term_id');
            $table->integer('session_id');
            $table->integer('school_id');
            $table->integer('description');
            $table->decimal('amount',20,2);
            $table->enum('payment_status',['paid','pending','cancelled']);
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
        Schema::dropIfExists('invoice_breakdowns');
    }
}
