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
        Schema::create('subscription_subscription', function (Blueprint $table) {
            $table->id();

            $table->decimal('amount', 11)->nullable();
            $table->boolean('completed')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(false);
            $table->dateTime('expiry_date', 6)->nullable();
            $table->dateTime('last_upgrade_date', 6)->nullable();
            $table->longText('param')->nullable();
            $table->foreignId('payment_id')->constrained('account_payment')->onDelete('cascade')->nullable()->index('subscription_subscription_payment_id');
            $table->boolean('successful')->nullable()->default(false);
            $table->dateTime('upgrade_date', 6)->nullable();
            $table->foreignId('partner_id')->constrained('partner_partner')->onDelete('cascade')->nullable()->index('subscription_subscription_partner_id');
            $table->foreignId('package_id')->constrained('subscription_package')->onDelete('cascade')->nullable()->index('subscription_subscription_package_id');
            $table->boolean('paid')->nullable()->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_subscription');
    }
};
