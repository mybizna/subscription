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
        Schema::create('subscription_package', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->decimal('amount', 11)->nullable();
            $table->longText('description');
            $table->integer('no_of_days')->nullable();
            $table->boolean('recurrence')->nullable()->default(false);
            $table->boolean('published')->nullable()->default(false);
            $table->decimal('setup_fee', 11)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_package');
    }
};
