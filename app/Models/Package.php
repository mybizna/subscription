<?php

namespace Modules\Subscription\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

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


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->string('title');
        $table->decimal('amount', 11)->nullable();
        $table->longText('description');
        $table->integer('no_of_days')->nullable();
        $table->boolean('recurrence')->nullable()->default(false);
        $table->boolean('published')->nullable()->default(false);
        $table->decimal('setup_fee', 11)->nullable();

    }
}
