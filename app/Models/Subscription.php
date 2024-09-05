<?php

namespace Modules\Subscription\Models;

use Modules\Account\Models\Payment;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Modules\Subscription\Models\Package;

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
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Add relationship to Package
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

}
