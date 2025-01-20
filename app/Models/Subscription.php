<?php
namespace Modules\Subscription\Models;

use Base\Casts\Money;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Account\Models\Payment;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Modules\Subscription\Models\Package;

class Subscription extends BaseModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => Money::class, // Use the custom MoneyCast
    ];
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

        $table->integer('amount')->nullable();
        $table->string('currency')->default('USD');
        $table->boolean('completed')->nullable()->default(false);
        $table->boolean('status')->nullable()->default(false);
        $table->dateTime('expiry_date', 6)->nullable();
        $table->dateTime('last_upgrade_date', 6)->nullable();
        $table->longText('param')->nullable();
        $table->unsignedBigInteger('payment_id')->nullable();
        $table->boolean('successful')->nullable()->default(false);
        $table->dateTime('upgrade_date', 6)->nullable();
        $table->unsignedBigInteger('partner_id')->nullable();
        $table->unsignedBigInteger('package_id')->nullable();
        $table->boolean('paid')->nullable()->default(false);

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('payment_id')->nullable()->constrained(table: 'account_payment')->onDelete('set null');
        $table->foreign('partner_id')->nullable()->constrained(table: 'partner_partner')->onDelete('set null');
        $table->foreign('package_id')->nullable()->constrained(table: 'subscription_package')->onDelete('set null');
    }
}
