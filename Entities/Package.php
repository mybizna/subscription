<?php

namespace Modules\Subscription\Entities;

use Modules\Base\Entities\BaseModel;

class Package extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'title', 'amount', 'description', 'no_of_days', 'recurrence', 'published', 'setup_fee'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "subscription_package";

}
