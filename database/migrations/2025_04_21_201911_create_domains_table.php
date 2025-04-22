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
    Schema::create('domains', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('tld', 10);
        $table->decimal('cost_price', 10, 2);
        $table->timestamp('registered_at');
        $table->decimal('buy_now_price', 10, 2)->nullable();
        $table->decimal('minimum_bid', 10, 2)->nullable();
        $table->boolean('excluded')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
