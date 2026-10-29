<?php

namespace App\Exports;

use App\Models\PupukTerpakai;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class PupukTerpakaiExport implements FromQuery, WithHeadings, WithMapping
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
        $query = PupukTerpakai::query()->with('user', 'pupuk');

        if ($this->tahun) {
            $query->whereYear('tanggal_pakai', $this->tahun);
        } elseif ($this->tanggal_mulai && $this->tanggal_selesai) {
            $query->whereBetween('tanggal_pakai', [$this->tanggal_mulai, $this->tanggal_selesai]);
        }

        return $query->orderBy('tanggal_pakai', 'desc');
    }

    public function headings(): array
    {
        return [
            'Tanggal Pakai',
            'Jenis Pupuk',
            'Kuantitas',
            'Satuan',
            'Lahan/Blok',
            'Tujuan Aplikasi',
            'Keterangan',
            'Admin',
        ];
    }

    public function map($row): array
    {
        return [
            $row->tanggal_pakai->format('d/m/Y'),
            $row->pupuk->nama_pupuk ?? '-',
            $row->kuantitas,
            $row->pupuk->satuan ?? '-',
            $row->lahan_blok ?? '-',
            $row->tujuan_aplikasi ?? '-',
            $row->keterangan ?? '-',
            $row->user->name ?? '-',
        ];
    }
}
