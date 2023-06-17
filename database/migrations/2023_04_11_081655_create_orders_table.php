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
            $table->foreignId('user_id')->constrained('customer_auths')->onDelete('cascade');
            $table->foreignId('billing_id')->constrained('billings')->onDelete('cascade');
            $table->string('sub_total');
            // $table->decimal('sub_total', 8, 2);
            // $table->decimal('discount_amount', 8, 2)->default(0);
            $table->string('discount_amount')->default(0);
            $table->string('coupon_name')->nullable();
            $table->string('shipping_charge')->nullable();
            // $table->decimal('total', 8, 2);
            $table->string('total');
            $table->string('status')->default(0);
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
};
