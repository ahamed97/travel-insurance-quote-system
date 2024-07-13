<?php

use App\Enums\Destination;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->enum('destination', Destination::toArray());
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('medical_expenses');
            $table->boolean('trip_cancellation');
            $table->integer('number_of_travelers');
            $table->decimal('quote_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
