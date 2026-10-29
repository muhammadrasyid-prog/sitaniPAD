<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerawatanLahan extends Model
{
    use SoftDeletes;

    protected $table = 'perawatan_lahan';

    protected $fillable = [
        'tanggal',
        'deskripsi',
        'kategori_biaya',
        'biaya',
        'bukti_foto',
        'keterangan',
        'user_id',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'biaya' => 'decimal:2',
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
