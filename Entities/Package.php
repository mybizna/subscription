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
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['title'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = [];

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

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['title', 'amount', 'no_of_days', 'recurrence', 'published', 'setup_fee'];
        $structure['form'] = [
            ['label' => 'Package Detail', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['title', 'amount', 'no_of_days', 'recurrence', 'published', 'setup_fee']],
            ['label' => 'Package Setting', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['description']],
        ];
        $structure['filter'] = ['title', 'amount', 'no_of_days', 'recurrence', 'published', 'setup_fee'];
        return $structure;
    }
}
