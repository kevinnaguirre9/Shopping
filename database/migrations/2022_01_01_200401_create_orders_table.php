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
            $table->timestamp('order_date')->useCurrent();
            $table->timestamp('delivery_date')->nullable();
            $table->string('shipper', 100);
            $table->string('consignee', 100);
            $table->string('carrier', 100);
            $table->string('tracking', 20);
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->decimal('total_price', 7, 2);
            $table->text('purchase_detail');
            $table->foreignId('customer_id')->constrained('users');
            $table->string('invoice_file');
            $table->timestamps();
            $table->softDeletes();
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
