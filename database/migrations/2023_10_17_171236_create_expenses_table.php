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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('title'); // Income title
            $table->text('description')->nullable(); // Description (optional)
            $table->decimal('amount', 10, 2); // Income amount (decimal with 10 digits, 2 decimal places)
            $table->date('date'); // Date of the income
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
