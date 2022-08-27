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
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->foreignId('user_id')->constrained('users');

            $table->string('vendor_order_id')->nullable();
            $table->string('transaction_id')->nullable();

            $table->string('name', 35);
            $table->string('surname', 50);
            $table->string('phone', 15);
            $table->string('email');
            $table->string('country', 50);
            $table->string('city', 50);
            $table->string('address', 50);

            $table->float('total');

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
