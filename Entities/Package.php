<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Schema\Blueprint;
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

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id')->html('hidden');
        $this->fields->string('title')->html('text');
        $this->fields->decimal('amount', 11)->nullable()->html('amount');
        $this->fields->longText('description')->html('text');
        $this->fields->integer('no_of_days')->nullable()->html('number');
        $this->fields->boolean('recurrence')->nullable()->html('switch')->default(false);
        $this->fields->boolean('published')->nullable()->html('switch')->default(false);
        $this->fields->decimal('setup_fee', 11)->nullable()->html('number');

    }



}
