<?php

namespace App\Filament\Resources\PerawatanLahanResource\Pages;

use App\Filament\Resources\PerawatanLahanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePerawatanLahans extends ManageRecords
{
    protected static string $resource = PerawatanLahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
