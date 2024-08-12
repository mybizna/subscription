<?php

namespace Modules\Subscription\Filament\Resources\SubscriptionResource\Pages;

use Modules\Subscription\Filament\Resources\SubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;
}
