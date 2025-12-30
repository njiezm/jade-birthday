<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('paypal_order_id')->nullable()->after('status');
            $table->string('stripe_session_id')->nullable()->after('paypal_order_id');
            $table->string('payment_method')->default('paypal')->after('stripe_session_id');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['paypal_order_id', 'stripe_session_id', 'payment_method']);
        });
    }
};