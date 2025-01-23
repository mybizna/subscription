<?php

namespace Modules\Subscription\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Subscription\Models\Package;

class PackageResource extends BaseResource
{
    protected static ?string $model = Package::class;

    protected static ?string $slug = 'subscription/package';

    protected static ?string $navigationGroup = 'Subscription';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
