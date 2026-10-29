<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Support\Icons\Heroicon;

use App\Filament\Resources\PupukTerpakaiResource\Pages\ManagePupukTerpakais;
use App\Models\PupukTerpakai;
use App\Exports\PupukTerpakaiExport;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class PupukTerpakaiResource extends Resource
{
    protected static ?string $model = PupukTerpakai::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowUpTray;
    protected static \UnitEnum|string|null $navigationGroup = 'Pupuk';
    protected static ?string $modelLabel = 'Pupuk Terpakai';
    protected static ?string $pluralModelLabel = 'Pupuk Terpakai';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                DatePicker::make('tanggal_pakai')
                    ->label('Tanggal Pakai')
                    ->required()
                    ->default(now()),
                TextInput::make('nama_pupuk')
                    ->label('Nama Pupuk (Kotoran Sapi, dll)')
                    ->required()
                    ->maxLength(255),
                TextInput::make('satuan')
                    ->label('Satuan (Karung, Truk, dll)')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kuantitas')
                    ->label('Kuantitas')
                    ->required()
                    ->numeric()
                    ->prefixIcon('heroicon-o-square-3-stack-3d'),
                TextInput::make('lahan_blok')
                    ->label('Lahan/Blok')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-map'),
                TextInput::make('tujuan_aplikasi')
                    ->label('Tujuan Aplikasi')
                    ->placeholder('Misal: Pemupukan dasar, Pemupukan susulan')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-target'),
                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull(),
                FileUpload::make('bukti_foto')
                    ->label('Bukti Foto')
                    ->image()
                    ->directory('evidence/pupuk-terpakai')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('tanggal_pakai')
                    ->label('Tanggal Pakai')
                    ->date('d M Y')
                    ->sortable()
                    ->size('md'),
                TextColumn::make('nama_pupuk')
                    ->label('Nama Pupuk')
                    ->searchable()
                    ->size('md')
                    ->weight('bold'),
                TextColumn::make('satuan')
                    ->label('Satuan')
                    ->size('md'),
                TextColumn::make('kuantitas')
                    ->label('Kuantitas')
                    ->sortable()
                    ->size('md'),
                TextColumn::make('lahan_blok')
                    ->label('Lahan/Blok')
                    ->searchable()
                    ->size('md'),
                TextColumn::make('tujuan_aplikasi')
                    ->label('Tujuan Aplikasi')
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
            ->defaultSort('tanggal_pakai', 'desc')
            ->paginated([10, 25, 50])
            ->filters([
                Filter::make('tanggal_pakai')
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
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_pakai', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_selesai'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_pakai', '<=', $date),
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

                        $export = new PupukTerpakaiExport($tahun, $tanggal_mulai, $tanggal_selesai);
                        $ext = $data['format'] === 'xlsx' ? 'xlsx' : 'csv';
                        $filename = 'pupuk-terpakai-' . now()->format('Y-m-d') . '.' . $ext;

                        return Excel::download($export, $filename);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePupukTerpakais::route('/'),
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
