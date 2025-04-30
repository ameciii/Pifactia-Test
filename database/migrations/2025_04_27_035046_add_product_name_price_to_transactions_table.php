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
        Schema::table('transactions', function ($table) {
            $table->string('product_name')->nullable();
            $table->decimal('product_price', 10, 2)->nullable();
        });
    }
    
    public function down(): void
    {
        Schema::table('transactions', function ($table) {
            $table->dropColumn(['product_name', 'product_price']);
        });
    }
    
};
