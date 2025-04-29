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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('document_type')->nullable();
            $table->string('document_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->unique(); 
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
