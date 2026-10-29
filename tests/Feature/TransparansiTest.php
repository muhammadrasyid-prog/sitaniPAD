<?php

namespace Tests\Feature;

use App\Models\PenjualanPanen;
use App\Models\PerawatanLahan;
use App\Models\KepentinganUmum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransparansiTest extends TestCase
{
    use RefreshDatabase;

    public function test_transparansi_page_displays_aggregate_data()
    {
        $user = User::factory()->create();

        // Create sample data for 2026
        PenjualanPanen::factory()->count(3)->create([
            'tanggal_jual' => '2026-06-15',
            'total_harga' => 1000000,
            'user_id' => $user->id,
        ]);

        PerawatanLahan::factory()->count(2)->create([
            'tanggal' => '2026-06-20',
            'biaya' => 500000,
            'user_id' => $user->id,
        ]);

        KepentinganUmum::factory()->count(1)->create([
            'tanggal' => '2026-06-25',
            'jumlah' => 200000,
            'user_id' => $user->id,
        ]);

        $response = $this->get('/transparansi');
        $response->assertStatus(200);
        $response->assertSeeText('Transparansi Dana Yayasan');
        $response->assertSeeText('2026');
    }

    public function test_transparansi_calculates_correct_totals()
    {
        $user = User::factory()->create();

        $pemasukan = 3000000;
        $perawatan = 800000;
        $kepentingan = 400000;

        PenjualanPanen::factory()->create([
            'tanggal_jual' => '2026-01-15',
            'total_harga' => $pemasukan,
            'user_id' => $user->id,
        ]);

        PerawatanLahan::factory()->create([
            'tanggal' => '2026-01-20',
            'biaya' => $perawatan,
            'user_id' => $user->id,
        ]);

        KepentinganUmum::factory()->create([
            'tanggal' => '2026-01-25',
            'jumlah' => $kepentingan,
            'user_id' => $user->id,
        ]);

        $response = $this->get('/transparansi');
        $response->assertStatus(200);
        
        // Check if totals appear in response (formatted as currency)
        $expectedPemasukan = 'Rp 3.000.000';
        $expectedPengeluaran = 'Rp 1.200.000';
        
        $this->assertStringContainsString($expectedPemasukan, $response->getContent());
        $this->assertStringContainsString($expectedPengeluaran, $response->getContent());
    }

    public function test_transparansi_shows_multiple_years()
    {
        $user = User::factory()->create();

        // Create data for 2025
        PenjualanPanen::factory()->create([
            'tanggal_jual' => '2025-01-15',
            'total_harga' => 2000000,
            'user_id' => $user->id,
        ]);

        // Create data for 2026
        PenjualanPanen::factory()->create([
            'tanggal_jual' => '2026-01-15',
            'total_harga' => 3000000,
            'user_id' => $user->id,
        ]);

        $response = $this->get('/transparansi');
        $response->assertStatus(200);
        $response->assertSeeText('2026');
        $response->assertSeeText('2025');
    }

    public function test_transparansi_page_accessible_without_login()
    {
        $response = $this->get('/transparansi');
        $response->assertStatus(200);
    }
}
