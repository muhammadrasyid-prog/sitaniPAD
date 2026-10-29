<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanPanen extends Model
{
    use SoftDeletes;

    protected $table = 'penjualan_panen';

    protected $fillable = [
        'jenis_tanaman',
        'tanggal_jual',
        'kuantitas',
        'satuan',
        'harga_satuan',
        'total_harga',
        'pembeli',
        'bukti_foto',
        'keterangan',
        'user_id',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_jual' => 'date',
            'kuantitas' => 'decimal:2',
            'harga_satuan' => 'decimal:2',
            'total_harga' => 'decimal:2',
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
