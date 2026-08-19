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
        Schema::create('affiliate', function (Blueprint $table) {
            $table->id();
            $table->string('affiliate_code')->unique();
            $table->string('affiliate_name')->unique();
            $table->json('affiliate_type');
            $table->integer('accounts_payable')->default(0);
            $table->integer('accounts_receivable')->default(0);
            $table->enum('status', ['Pending', 'Active', 'Inactive'])->default('Pending');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate');
    }
};
