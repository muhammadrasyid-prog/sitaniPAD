<?php

namespace App\Filament\Resources\PenjualanPanenResource\Pages;

use App\Filament\Resources\PenjualanPanenResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePenjualanPanens extends ManageRecords
{
    protected static string $resource = PenjualanPanenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
