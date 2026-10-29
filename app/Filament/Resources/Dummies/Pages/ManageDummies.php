<?php

namespace App\Filament\Resources\Dummies\Pages;

use App\Filament\Resources\Dummies\DummyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDummies extends ManageRecords
{
    protected static string $resource = DummyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
