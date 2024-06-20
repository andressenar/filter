<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('order_date');
            $table->enum('order_status', ['pending', 'preparing', 'ready', 'delivered'])->default('pending');
            $table->decimal('total_amount', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}

