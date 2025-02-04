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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('full_name'); // Full name of the enquirer
            $table->string('mobile'); // Mobile number
            $table->string('location'); // Location
            $table->decimal('loan_amt', 10, 2); // Loan amount with 2 decimal precision
            $table->string('stage')->default('New'); // Stage of the enquiry
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
