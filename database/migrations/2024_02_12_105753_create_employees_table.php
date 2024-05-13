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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 4)->unique(); // Employee ID, 4 digits, unique
            $table->string('full_name');
            $table->string('image')->nullable(); // Image field, can be nullable
            $table->string('address');
            $table->string('contact_number');
            $table->string('nid_number');
            $table->string('email')->unique();
            $table->date('date_of_birth');
           
            $table->string('position_title');
            $table->string('department');
            $table->date('start_date');
            $table->string('employment_status');
            $table->string('work_location');
            $table->decimal('salary', 10, 2); // Decimal for salary
            $table->string('site_manager_name');
            $table->string('manager_contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
