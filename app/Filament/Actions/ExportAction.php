<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Maatwebsite\Excel\Facades\Excel;

class ExportAction
{
    public static function make(string $exportClass, string $filename): Action
    {
        return Action::make('export')
            ->label('Export')
            ->icon('heroicon-o-arrow-down-tray')
            ->form([
                Radio::make('filter_type')
                    ->label('Jenis Filter')
                    ->options([
                        'tahun' => 'Per Tahun',
                        'range' => 'Rentang Tanggal',
                    ])
                    ->default('tahun')
                    ->live(),
                Radio::make('tahun')
                    ->label('Pilih Tahun')
                    ->options(self::getAvailableYears())
                    ->visible(fn ($get) => $get('filter_type') === 'tahun'),
                DatePicker::make('tanggal_mulai')
                    ->label('Dari Tanggal')
                    ->visible(fn ($get) => $get('filter_type') === 'range'),
                DatePicker::make('tanggal_selesai')
                    ->label('Sampai Tanggal')
                    ->visible(fn ($get) => $get('filter_type') === 'range'),
                Radio::make('format')
                    ->label('Format File')
                    ->options([
                        'xlsx' => 'Excel (.xlsx)',
                        'csv' => 'CSV (.csv)',
                    ])
                    ->default('xlsx'),
            ])
            ->action(function (array $data) use ($exportClass, $filename) {
                $tahun = null;
                $tanggal_mulai = null;
                $tanggal_selesai = null;

                if ($data['filter_type'] === 'tahun') {
                    $tahun = $data['tahun'];
                } else {
                    $tanggal_mulai = $data['tanggal_mulai'];
                    $tanggal_selesai = $data['tanggal_selesai'];
                }

                $export = new $exportClass($tahun, $tanggal_mulai, $tanggal_selesai);
                $ext = $data['format'] === 'xlsx' ? 'xlsx' : 'csv';
                $filenameWithDate = $filename . '-' . now()->format('Y-m-d') . '.' . $ext;

                return Excel::download($export, $filenameWithDate);
            });
    }

    private static function getAvailableYears(): array
    {
        $currentYear = now()->year;
        $years = [];
        for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
            $years[$i] = $i;
        }
        return $years;
    }
}
