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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order_id')->nullable();
            $table->double('sub_total', 10, 2)->default(0);
            $table->string('coupon')->nullable();
            $table->double('coupon_discount', 10, 2)->default(0);
            $table->double('shipping', 10, 2)->default(0);
            $table->double('tax', 10, 2)->default(0);
            $table->double('total', 10, 2)->default(0);
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
        Schema::dropIfExists('carts');
    }
};
