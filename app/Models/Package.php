<?php
namespace Modules\Subscription\Models;

use Base\Casts\Money;
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Models\BaseModel;

class Package extends BaseModel
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
    protected $fillable = ['id', 'title', 'amount', 'description', 'no_of_days', 'recurrence', 'published', 'setup_fee'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "subscription_package";

    public function migration(Blueprint $table): void
    {

        $table->string('title');
        $table->integer('amount', )->nullable();
        $table->string('currency')->default('USD');
        $table->longText('description');
        $table->integer('no_of_days')->nullable();
        $table->boolean('recurrence')->nullable()->default(false);
        $table->boolean('published')->nullable()->default(false);
        $table->integer('setup_fee')->nullable();

    }
}
