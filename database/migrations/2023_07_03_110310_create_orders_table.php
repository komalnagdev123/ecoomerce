<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table->string('order_no');
            $table->date('order_date');
            $table->date('estimate_delivery_date');
            $table->integer('total_qty')->default(0);
            $table->double('ship_price')->default(0);
            $table->unsignedBigInteger('order_status_id');
            $table->double('total_amount');
            $table->tinyInteger('status')->default(0);
            $table->integer('cancelled_by_user_id')->nullable();
            $table->string('product_cancel_reason_text')->nullable();
            $table->string('product_cancel_feedback')->nullable();
            $table->integer('status_update_date')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_statuses');

          
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments');

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
}
