<?php

namespace Modules\Subscription\Entities;

use Modules\Base\Entities\BaseModel;

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

}
