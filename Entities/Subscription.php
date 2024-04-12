<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Schema\Blueprint;
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
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = [
        'fields' => ['partner_id__name', 'package_id__title'],
        'template' => "[partner_id__name] ([package_id__title]) "];

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
    protected $table = "subscription_subscription";

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
        $this->fields->decimal('amount', 11)->nullable()->html('amount');
        $this->fields->boolean('completed')->nullable()->html('switch')->default(false);
        $this->fields->boolean('status')->nullable()->html('switch')->default(false);
        $this->fields->dateTime('expiry_date', 6)->nullable()->html('datetime');
        $this->fields->dateTime('last_upgrade_date', 6)->nullable()->html('datetime');
        $this->fields->longText('param')->nullable()->html('text');
        $this->fields->bigInteger('payment_id')->nullable()->html('recordpicker')->relation(['account', 'invoice']);
        $this->fields->boolean('successful')->nullable()->html('switch')->default(false);
        $this->fields->dateTime('upgrade_date', 6)->nullable()->html('datetime');
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);
        $this->fields->bigInteger('package_id')->nullable()->html('recordpicker')->relation(['subscription', 'subscription']);
        $this->fields->boolean('paid')->nullable()->html('switch')->default(false);

    }
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['partner_id', 'package_id', 'payment_id', 'amount', 'expiry_date', 'last_upgrade_date', 'upgrade_date', 'completed', 'status', 'successful', 'paid'];
        $structure['form'] = [
            ['label' => 'Subscription Detail', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['partner_id', 'package_id', 'amount', 'payment_id', 'upgrade_date', '']],
            ['label' => 'Subscription Setting', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['completed', 'status', 'successful', 'upgrade_date', 'paid']],
            ['label' => 'Subscription Params', 'class' => 'col-span-full', 'fields' => ['param']],
        ];
        $structure['filter'] = ['partner_id', 'package_id', 'amount', 'completed', 'status', 'expiry_date', 'last_upgrade_date', 'param', 'payment_id', 'successful', 'upgrade_date', 'paid'];
        return $structure;
    }


    /**
     * Define rights for this model.
     *
     * @return array
     */
    public function rights(): array
    {
        $rights = parent::rights();

        $rights['staff'] = ['view' => true];
        $rights['registered'] = ['view' => true];
        $rights['guest'] = [];

        return $rights;
    }
}
