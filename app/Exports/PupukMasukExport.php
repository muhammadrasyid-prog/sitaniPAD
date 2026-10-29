<?php

namespace App\Exports;

use App\Models\PupukMasuk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class PupukMasukExport implements FromQuery, WithHeadings, WithMapping
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
        $query = PupukMasuk::query()->with('user', 'pupuk');

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
            'Jenis Pupuk',
            'Kuantitas',
            'Satuan',
            'Harga Satuan (Rp)',
            'Total Harga (Rp)',
            'Supplier',
            'Keterangan',
            'Admin',
        ];
    }

    public function map($row): array
    {
        return [
            $row->tanggal->format('d/m/Y'),
            $row->pupuk->nama_pupuk ?? '-',
            $row->kuantitas,
            $row->pupuk->satuan ?? '-',
            $row->harga_satuan,
            $row->total_harga,
            $row->supplier ?? '-',
            $row->keterangan ?? '-',
            $row->user->name ?? '-',
        ];
    }
}
