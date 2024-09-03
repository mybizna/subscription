<?php

namespace Modules\Subscription\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class SubscriptionPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Subscription';
    }

    public function getId(): string
    {
        return 'subscription';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
