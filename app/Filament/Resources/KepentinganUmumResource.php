<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Support\Icons\Heroicon;

use App\Filament\Resources\KepentinganUmumResource\Pages\ManageKepentinganUmums;
use App\Models\KepentinganUmum;
use App\Exports\KepentinganUmumExport;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class KepentinganUmumResource extends Resource
{
    protected static ?string $model = KepentinganUmum::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;
    protected static \UnitEnum|string|null $navigationGroup = 'Keuangan';
    protected static ?string $modelLabel = 'Kepentingan Umum';
    protected static ?string $pluralModelLabel = 'Kepentingan Umum';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
                    ->default(now()),
                TextInput::make('kategori_kegiatan')
                    ->label('Kategori Kegiatan')
                    ->placeholder('Misal: Pendidikan, Infrastruktur')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-tag'),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('jumlah')
                    ->label('Jumlah (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->prefixIcon('heroicon-o-currency-dollar'),
                Textarea::make('keterangan')
                    ->label('Keterangan Tambahan')
                    ->columnSpanFull(),
                FileUpload::make('bukti_foto')
                    ->label('Bukti Foto (Bisa lebih dari 1)')
                    ->image()
                    ->multiple()
                    ->directory('evidence/kepentingan-umum')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('tampil_di_landing')
                    ->label('Tampilkan di Landing Page?')
                    ->default(false),
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
                TextColumn::make('kategori_kegiatan')
                    ->label('Kategori Kegiatan')
                    ->searchable()
                    ->size('md')
                    ->weight('bold'),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable()
                    ->size('md'),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->size('lg')
                    ->weight('bold')
                    ->color('info'),
                TextColumn::make('user.name')
                    ->label('Admin')
                    ->sortable()
                    ->size('sm'),
                ToggleColumn::make('tampil_di_landing')
                    ->label('Tampil Publik'),
                ImageColumn::make('bukti_foto')
                    ->label('Bukti Foto')
                    ->circular()
                    ->stacked()
                    ->limit(3)
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

                        $export = new KepentinganUmumExport($tahun, $tanggal_mulai, $tanggal_selesai);
                        $ext = $data['format'] === 'xlsx' ? 'xlsx' : 'csv';
                        $filename = 'kepentingan-umum-' . now()->format('Y-m-d') . '.' . $ext;

                        return Excel::download($export, $filename);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageKepentinganUmums::route('/'),
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
