<?php

namespace App\Filament\Resources\PupukTerpakaiResource\Pages;

use App\Filament\Resources\PupukTerpakaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePupukTerpakais extends ManageRecords
{
    protected static string $resource = PupukTerpakaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
