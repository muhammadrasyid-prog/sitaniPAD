<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return (bool) $this->is_super_admin;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function penjualanPanen(): HasMany
    {
        return $this->hasMany(PenjualanPanen::class);
    }

    public function perawatanLahan(): HasMany
    {
        return $this->hasMany(PerawatanLahan::class);
    }

    public function kepentinganUmum(): HasMany
    {
        return $this->hasMany(KepentinganUmum::class);
    }

    public function pupukMasuk(): HasMany
    {
        return $this->hasMany(PupukMasuk::class);
    }

    public function pupukTerpakai(): HasMany
    {
        return $this->hasMany(PupukTerpakai::class);
    }
}
