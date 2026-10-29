<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KepentinganUmum extends Model
{
    use SoftDeletes;

    protected $table = 'kepentingan_umum';

    protected $fillable = [
        'tanggal',
        'kategori_kegiatan',
        'deskripsi',
        'jumlah',
        'bukti_foto',
        'tampil_di_landing',
        'keterangan',
        'user_id',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah' => 'decimal:2',
            'bukti_foto' => 'array',
            'tampil_di_landing' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (auth()->check()) {
                $model->user_id = auth()->id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
