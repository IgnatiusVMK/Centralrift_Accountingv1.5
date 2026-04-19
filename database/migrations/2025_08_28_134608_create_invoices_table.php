<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('invoice_number')->unique();
            $table->string('order_number')->nullable();
            $table->date('date');
            /* $table->enum('status', ['draft', 'final'])->default('draft'); */
            $table->string('currency')->default('KES');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->decimal('total', 12, 2)->default(0);
            $table->date('date_paid')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
