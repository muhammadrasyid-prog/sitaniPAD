<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PupukTerpakai extends Model
{
    use SoftDeletes;

    protected $table = 'pupuk_terpakai';

    protected $fillable = [
        'tanggal_pakai',
        'nama_pupuk',
        'satuan',
        'kuantitas',
        'lahan_blok',
        'tujuan_aplikasi',
        'bukti_foto',
        'keterangan',
        'user_id',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pakai' => 'date',
            'kuantitas' => 'decimal:2',
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
