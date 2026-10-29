<?php

namespace App\Filament\Resources\KepentinganUmumResource\Pages;

use App\Filament\Resources\KepentinganUmumResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKepentinganUmums extends ManageRecords
{
    protected static string $resource = KepentinganUmumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
