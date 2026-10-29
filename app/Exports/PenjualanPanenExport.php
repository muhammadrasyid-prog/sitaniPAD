<?php

namespace App\Exports;

use App\Models\PenjualanPanen;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class PenjualanPanenExport implements FromQuery, WithHeadings, WithMapping
{
    protected $tahun;
    protected $tanggal_mulai;
    protected $tanggal_selesai;

    public function __construct($tahun = null, $tanggal_mulai = null, $tanggal_selesai = null)
    {
        $this->tahun = $tahun;
        $this->tanggal_mulai = $tanggal_mulai;
        $this->tanggal_selesai = $tanggal_selesai;
    }

    public function query(): Builder
    {
        $query = PenjualanPanen::query()->with('user');

        if ($this->tahun) {
            $query->whereYear('tanggal_jual', $this->tahun);
        } elseif ($this->tanggal_mulai && $this->tanggal_selesai) {
            $query->whereBetween('tanggal_jual', [$this->tanggal_mulai, $this->tanggal_selesai]);
        }

        return $query->orderBy('tanggal_jual', 'desc');
    }

    public function headings(): array
    {
        return [
            'Tanggal Jual',
            'Jenis Tanaman',
            'Tanggal Tanam',
            'Kuantitas',
            'Satuan',
            'Harga Satuan (Rp)',
            'Total Harga (Rp)',
            'Pembeli',
            'Keterangan',
            'Admin',
        ];
    }

    public function map($row): array
    {
        return [
            $row->tanggal_jual->format('d/m/Y'),
            $row->jenis_tanaman,
            $row->tanggal_tanam->format('d/m/Y'),
            $row->kuantitas,
            $row->satuan,
            $row->harga_satuan,
            $row->total_harga,
            $row->pembeli ?? '-',
            $row->keterangan ?? '-',
            $row->user->name ?? '-',
        ];
    }
}
