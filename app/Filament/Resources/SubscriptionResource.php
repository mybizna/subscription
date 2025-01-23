<?php

namespace Modules\Subscription\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Subscription\Models\Subscription;

class SubscriptionResource extends BaseResource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $slug = 'subscription/subscription';

    protected static ?string $navigationGroup = 'Subscription';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
