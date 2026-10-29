<?php

namespace App\Exports;

use App\Models\KepentinganUmum;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class KepentinganUmumExport implements FromQuery, WithHeadings, WithMapping
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
        $query = KepentinganUmum::query()->with('user');

        if ($this->tahun) {
            $query->whereYear('tanggal', $this->tahun);
        } elseif ($this->tanggal_mulai && $this->tanggal_selesai) {
            $query->whereBetween('tanggal', [$this->tanggal_mulai, $this->tanggal_selesai]);
        }

        return $query->orderBy('tanggal', 'desc');
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Kategori Kegiatan',
            'Deskripsi',
            'Jumlah (Rp)',
            'Keterangan',
            'Admin',
        ];
    }

    public function map($row): array
    {
        return [
            $row->tanggal->format('d/m/Y'),
            $row->kategori_kegiatan,
            $row->deskripsi,
            $row->jumlah,
            $row->keterangan ?? '-',
            $row->user->name ?? '-',
        ];
    }
}
