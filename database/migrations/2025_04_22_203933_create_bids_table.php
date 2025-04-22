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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained()->onDelete('cascade');
            $table->string('user_email')->nullable();      // bij anonimiteit
            $table->decimal('amount', 10, 2);
            $table->timestamp('accepted_at')->nullable();  // voor geaccepteerde biedingen
            $table->string('accept_token')->unique();     // voor veilige signed link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};

