<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResourcesResource\RelationManagers\AddressRelationManager;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getRelationManagers(): array
    {
        return [
            \App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager::class,
        ];
    }
}
