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
            $table->foreignId('payment_id')->nullable()->constrained('account_payment')->onDelete('set null');
            $table->boolean('successful')->nullable()->default(false);
            $table->dateTime('upgrade_date', 6)->nullable();
            $table->foreignId('partner_id')->nullable()->constrained('partner_partner')->onDelete('set null');
            $table->foreignId('package_id')->nullable()->constrained('subscription_package')->onDelete('set null');
            $table->boolean('paid')->nullable()->default(false);

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
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
