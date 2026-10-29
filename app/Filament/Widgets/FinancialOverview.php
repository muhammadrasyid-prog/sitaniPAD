<?php

namespace App\Filament\Widgets;

use App\Models\KepentinganUmum;
use App\Models\PerawatanLahan;
use App\Models\PenjualanPanen;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class FinancialOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentYear = Carbon::now()->year;

        $totalPenjualan = PenjualanPanen::whereYear('tanggal_jual', $currentYear)
            ->sum('total_harga');

        $totalPerawatan = PerawatanLahan::whereYear('tanggal', $currentYear)
            ->sum('biaya');

        $totalKepentingan = KepentinganUmum::whereYear('tanggal', $currentYear)
            ->sum('jumlah');

        $totalPengeluaran = $totalPerawatan + $totalKepentingan;
        $saldoBersih = $totalPenjualan - $totalPengeluaran;

        return [
            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalPenjualan, 0, ',', '.'))
                ->description('Tahun ' . $currentYear)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalPengeluaran, 0, ',', '.'))
                ->description('Tahun ' . $currentYear)
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Saldo Bersih', 'Rp ' . number_format($saldoBersih, 0, ',', '.'))
                ->description('Tahun ' . $currentYear)
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($saldoBersih >= 0 ? 'success' : 'danger'),
        ];
    }
}
