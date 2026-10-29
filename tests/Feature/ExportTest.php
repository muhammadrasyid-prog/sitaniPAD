<?php

namespace Tests\Feature;

use App\Models\PenjualanPanen;
use App\Models\PerawatanLahan;
use App\Models\KepentinganUmum;
use App\Models\PupukMasuk;
use App\Models\PupukTerpakai;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    public function test_export_penjualan_panen_xlsx()
    {
        PenjualanPanen::factory()->count(5)->create(['user_id' => $this->admin->id]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/penjualan-panen/export', [
                'filter_type' => 'tahun',
                'tahun' => now()->year,
                'format' => 'xlsx',
            ]);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    public function test_export_penjualan_panen_csv()
    {
        PenjualanPanen::factory()->count(5)->create(['user_id' => $this->admin->id]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/penjualan-panen/export', [
                'filter_type' => 'tahun',
                'tahun' => now()->year,
                'format' => 'csv',
            ]);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv');
    }

    public function test_export_with_date_range_filter()
    {
        PenjualanPanen::factory()->create([
            'tanggal_jual' => '2026-01-15',
            'user_id' => $this->admin->id,
        ]);

        PenjualanPanen::factory()->create([
            'tanggal_jual' => '2026-06-15',
            'user_id' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/penjualan-panen/export', [
                'filter_type' => 'range',
                'tanggal_mulai' => '2026-01-01',
                'tanggal_selesai' => '2026-03-31',
                'format' => 'xlsx',
            ]);

        $response->assertStatus(200);
    }

    public function test_export_perawatan_lahan()
    {
        PerawatanLahan::factory()->count(3)->create(['user_id' => $this->admin->id]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/perawatan-lahan/export', [
                'filter_type' => 'tahun',
                'tahun' => now()->year,
                'format' => 'xlsx',
            ]);

        $response->assertStatus(200);
    }

    public function test_export_kepentingan_umum()
    {
        KepentinganUmum::factory()->count(3)->create(['user_id' => $this->admin->id]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/kepentingan-umum/export', [
                'filter_type' => 'tahun',
                'tahun' => now()->year,
                'format' => 'xlsx',
            ]);

        $response->assertStatus(200);
    }

    public function test_export_pupuk_masuk()
    {
        PupukMasuk::factory()->count(3)->create(['user_id' => $this->admin->id]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/pupuk-masuk/export', [
                'filter_type' => 'tahun',
                'tahun' => now()->year,
                'format' => 'xlsx',
            ]);

        $response->assertStatus(200);
    }

    public function test_export_pupuk_terpakai()
    {
        PupukTerpakai::factory()->count(3)->create(['user_id' => $this->admin->id]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/pupuk-terpakai/export', [
                'filter_type' => 'tahun',
                'tahun' => now()->year,
                'format' => 'xlsx',
            ]);

        $response->assertStatus(200);
    }

    public function test_export_with_empty_data()
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/penjualan-panen/export', [
                'filter_type' => 'tahun',
                'tahun' => 2020,
                'format' => 'xlsx',
            ]);

        // Should still return 200 with empty file
        $response->assertStatus(200);
    }

    public function test_guest_cannot_export()
    {
        $response = $this->post('/admin/penjualan-panen/export', [
            'filter_type' => 'tahun',
            'tahun' => now()->year,
            'format' => 'xlsx',
        ]);

        $response->assertRedirect('/admin/login');
    }
}
