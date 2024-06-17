<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStat;
use App\Filament\Resources\OrderResourcesResource\RelationManagers\AddressRelationManager;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array {
        return [
          OrderStat::class
        ];
    }

    public function getTabs(): array{
        return [
            null => Tab::make('All'),
            'new' => Tab::make()->query(fn ($query)=>$query->where('status','new')),
            'processing' => Tab::make()->query(fn ($query)=>$query->where('status','processing')),
            'delivered' => Tab::make()->query(fn ($query)=>$query->where('status','delivered')),
            'shipped' => Tab::make()->query(fn ($query)=>$query->where('status','shhipped')),
            'canceled' => Tab::make()->query(fn ($query)=>$query->where('status','canceled')),

        ];
    }


}
