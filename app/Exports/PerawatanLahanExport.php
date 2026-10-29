<?php

namespace App\Exports;

use App\Models\PerawatanLahan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class PerawatanLahanExport implements FromQuery, WithHeadings, WithMapping
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
        $query = PerawatanLahan::query()->with('user');

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
            'Deskripsi',
            'Kategori Biaya',
            'Biaya (Rp)',
            'Keterangan',
            'Admin',
        ];
    }

    public function map($row): array
    {
        return [
            $row->tanggal->format('d/m/Y'),
            $row->deskripsi,
            $row->kategori_biaya ?? '-',
            $row->biaya,
            $row->keterangan ?? '-',
            $row->user->name ?? '-',
        ];
    }
}
