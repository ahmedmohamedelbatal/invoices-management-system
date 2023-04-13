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
            $table->string('invoice_number');
            $table->string('invoice_product');
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->string('invoice_discount');
            $table->string('invoice_rate_vat');
            $table->decimal('invoice_value_vat', 8, 2);
            $table->decimal('invoice_total', 8, 2);
            $table->decimal('invoice_amount_collection', 8, 2)->nullable();
            $table->decimal('invoice_amount_commission', 8, 2);
            $table->string('invoice_status', 50);
            $table->integer('invoice_value_status');
            $table->text('invoice_note')->nullable();
            $table->date('invoice_date');
            $table->date('invoice_due_date');
            $table->string('invoice_attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
