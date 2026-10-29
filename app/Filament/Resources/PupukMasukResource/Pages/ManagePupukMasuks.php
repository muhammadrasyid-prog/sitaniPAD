<?php

namespace App\Filament\Resources\PupukMasukResource\Pages;

use App\Filament\Resources\PupukMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePupukMasuks extends ManageRecords
{
    protected static string $resource = PupukMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
