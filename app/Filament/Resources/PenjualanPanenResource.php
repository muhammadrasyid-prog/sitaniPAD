<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Support\Icons\Heroicon;

use App\Filament\Resources\PenjualanPanenResource\Pages\ManagePenjualanPanens;
use App\Models\PenjualanPanen;
use App\Exports\PenjualanPanenExport;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class PenjualanPanenResource extends Resource
{
    protected static ?string $model = PenjualanPanen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static \UnitEnum|string|null $navigationGroup = 'Keuangan';
    protected static ?string $modelLabel = 'Penjualan Panen';
    protected static ?string $pluralModelLabel = 'Penjualan Panen';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('jenis_tanaman')
                    ->label('Jenis Tanaman')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-globe-alt'),
                DatePicker::make('tanggal_jual')
                    ->label('Tanggal Jual/Panen')
                    ->required()
                    ->default(now()),
                TextInput::make('kuantitas')
                    ->label('Kuantitas')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $set('total_harga', (float) $get('kuantitas') * (float) $get('harga_satuan'));
                    }),
                TextInput::make('satuan')
                    ->label('Satuan')
                    ->placeholder('kg / kwintal / ton')
                    ->required()
                    ->maxLength(255),
                TextInput::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $set('total_harga', (float) $get('kuantitas') * (float) $get('harga_satuan'));
                    }),
                TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->readOnly(),
                TextInput::make('pembeli')
                    ->label('Nama Pembeli')
                    ->maxLength(255),
                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull(),
                FileUpload::make('bukti_foto')
                    ->label('Bukti Foto')
                    ->image()
                    ->directory('evidence/penjualan-panen')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('jenis_tanaman')
                    ->label('Jenis Tanaman')
                    ->searchable()
                    ->size('lg')
                    ->weight('bold'),
                TextColumn::make('tanggal_jual')
                    ->label('Tanggal Jual')
                    ->date('d M Y')
                    ->sortable()
                    ->size('md'),
                TextColumn::make('kuantitas')
                    ->label('Kuantitas')
                    ->formatStateUsing(fn ($record) => $record->kuantitas . ' ' . $record->satuan)
                    ->sortable()
                    ->size('md'),
                TextColumn::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->size('md'),
                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->size('lg')
                    ->weight('bold')
                    ->color('success'),
                TextColumn::make('pembeli')
                    ->label('Pembeli')
                    ->searchable()
                    ->size('md'),
                TextColumn::make('user.name')
                    ->label('Admin')
                    ->sortable()
                    ->size('sm'),
                ImageColumn::make('bukti_foto')
                    ->label('Bukti Foto')
                    ->circular()
                    ->size(48),
            ])
            ->defaultSort('tanggal_jual', 'desc')
            ->paginated([10, 25, 50])
            ->filters([
                Filter::make('tanggal_jual')
                    ->form([
                        DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Jual Mulai'),
                        DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Jual Selesai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tanggal_mulai'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_jual', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_selesai'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_jual', '<=', $date),
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

                        $export = new PenjualanPanenExport($tahun, $tanggal_mulai, $tanggal_selesai);
                        $ext = $data['format'] === 'xlsx' ? 'xlsx' : 'csv';
                        $filename = 'penjualan-panen-' . now()->format('Y-m-d') . '.' . $ext;

                        return Excel::download($export, $filename);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePenjualanPanens::route('/'),
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
