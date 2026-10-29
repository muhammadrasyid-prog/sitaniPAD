<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Support\Icons\Heroicon;

use App\Filament\Resources\PerawatanLahanResource\Pages\ManagePerawatanLahans;
use App\Models\PerawatanLahan;
use App\Exports\PerawatanLahanExport;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class PerawatanLahanResource extends Resource
{
    protected static ?string $model = PerawatanLahan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;
    protected static \UnitEnum|string|null $navigationGroup = 'Keuangan';
    protected static ?string $modelLabel = 'Perawatan Lahan';
    protected static ?string $pluralModelLabel = 'Perawatan Lahan';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
                    ->default(now()),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('kategori_biaya')
                    ->label('Kategori Biaya')
                    ->placeholder('Misal: Tenaga Kerja, Bahan, Alat')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-tag'),
                TextInput::make('biaya')
                    ->label('Biaya (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->prefixIcon('heroicon-o-currency-dollar'),
                Textarea::make('keterangan')
                    ->label('Keterangan Tambahan')
                    ->columnSpanFull(),
                FileUpload::make('bukti_foto')
                    ->label('Bukti Foto')
                    ->image()
                    ->directory('evidence/perawatan-lahan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->size('md'),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable()
                    ->size('md')
                    ->weight('bold'),
                TextColumn::make('kategori_biaya')
                    ->label('Kategori Biaya')
                    ->searchable()
                    ->size('md'),
                TextColumn::make('biaya')
                    ->label('Biaya')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->size('lg')
                    ->weight('bold')
                    ->color('warning'),
                TextColumn::make('user.name')
                    ->label('Admin')
                    ->sortable()
                    ->size('sm'),
                ImageColumn::make('bukti_foto')
                    ->label('Bukti Foto')
                    ->circular()
                    ->size(48),
            ])
            ->defaultSort('tanggal', 'desc')
            ->paginated([10, 25, 50])
            ->filters([
                Filter::make('tanggal')
                    ->form([
                        DatePicker::make('tanggal_mulai')
                            ->label('Dari Tanggal'),
                        DatePicker::make('tanggal_selesai')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tanggal_mulai'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_selesai'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->button()
                    ->label('Edit'),
                DeleteAction::make()
                    ->button()
                    ->label('Hapus'),
            ])
            ->toolbarActions([
                Action::make('export')
                    ->label('Export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->button()
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
                    ->action(function (array $data) {
                        $tahun = null;
                        $tanggal_mulai = null;
                        $tanggal_selesai = null;

                        if ($data['filter_type'] === 'tahun') {
                            $tahun = $data['tahun'];
                        } else {
                            $tanggal_mulai = $data['tanggal_mulai'];
                            $tanggal_selesai = $data['tanggal_selesai'];
                        }

                        $export = new PerawatanLahanExport($tahun, $tanggal_mulai, $tanggal_selesai);
                        $ext = $data['format'] === 'xlsx' ? 'xlsx' : 'csv';
                        $filename = 'perawatan-lahan-' . now()->format('Y-m-d') . '.' . $ext;

                        return Excel::download($export, $filename);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePerawatanLahans::route('/'),
        ];
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
