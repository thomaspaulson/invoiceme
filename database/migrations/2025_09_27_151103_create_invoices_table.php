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
            $table->uuid('id')->primary();
            $table->json('client');
            $table->decimal('amount', total: 8, places: 2);
            $table->json('taxes');
            $table->decimal('tax_amount', total: 8, places: 2);
            $table->decimal('with_tax', total: 8, places: 2);
            $table->string('currency');
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('invoice_id');
            $table->string('name');
            $table->string('hsn_code');
            $table->integer('quantity');
            $table->decimal('rate', total: 8, places: 2);
            $table->decimal('tax_amount', total: 8, places: 2);
            $table->decimal('with_tax', total: 8, places: 2);
            $table->string('currency');
            $table->date("created_at");
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
    }
};
