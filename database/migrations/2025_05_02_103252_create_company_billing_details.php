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
        Schema::create('company_billing_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->string('plan')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('billing_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_billing_details');
    }
};
