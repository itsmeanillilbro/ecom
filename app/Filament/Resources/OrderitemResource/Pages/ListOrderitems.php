<?php

namespace App\Filament\Resources\OrderitemResource\Pages;

use App\Filament\Resources\OrderitemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderitems extends ListRecords
{
    protected static string $resource = OrderitemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
