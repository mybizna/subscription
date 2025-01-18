<?php

namespace Modules\Subscription\Models;

use Modules\Account\Models\Payment;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Modules\Subscription\Models\Package;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;

class Subscription extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'amount', 'completed', 'status', 'expiry_date', 'last_upgrade_date', 'param', 'payment_id', 'successful', 'upgrade_date', 'partner_id', 'package_id', 'paid'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "subscription_subscription";

    /**
     * Add relationship to Payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Add relationship to Package
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->decimal('amount', 11)->nullable();
        $table->boolean('completed')->nullable()->default(false);
        $table->boolean('status')->nullable()->default(false);
        $table->dateTime('expiry_date', 6)->nullable();
        $table->dateTime('last_upgrade_date', 6)->nullable();
        $table->longText('param')->nullable();
        $table->foreignId('payment_id')->nullable()->constrained(table: 'account_payment')->onDelete('set null');
        $table->boolean('successful')->nullable()->default(false);
        $table->dateTime('upgrade_date', 6)->nullable();
        $table->foreignId('partner_id')->nullable()->constrained(table: 'partner_partner')->onDelete('set null');
        $table->foreignId('package_id')->nullable()->constrained(table: 'subscription_package')->onDelete('set null');
        $table->boolean('paid')->nullable()->default(false);

    }
}
