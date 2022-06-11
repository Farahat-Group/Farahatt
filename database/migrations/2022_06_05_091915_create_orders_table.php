<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('cash');
            $table->enum('status' , ['in progress', 'accepted' , 'refused' , 'delivering' , 'delivered']);
            $table->tinyInteger('sale')->default(0);
            $table->float('final_cash');
            $table->enum('payment_method' , ['cash' , 'vodafone_cash'])->default('cash');
            $table->text('payment_code')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
