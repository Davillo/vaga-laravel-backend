<?php

use App\Constants\Order\OrderConstants;
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
            $table->bigIncrements('id');
            $table->enum('status', [OrderConstants::ORDER_STATUS_OPENED, OrderConstants::ORDER_STATUS_CHECKOUT])->default(OrderConstants::ORDER_STATUS_OPENED);
            $table->unsignedBigInteger('customer_id');
            $table->decimal('total', 10, 2)->default('0.00');

            $table->foreign('customer_id')->references('id')->on('customers');
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
