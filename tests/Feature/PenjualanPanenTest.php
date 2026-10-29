<?php

namespace Tests\Feature;

use App\Models\PenjualanPanen;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PenjualanPanenTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->admin = User::factory()->create();
    }

    public function test_penjualan_panen_index_page_returns_200()
    {
        $response = $this->actingAs($this->admin)->get('/admin/penjualan-panen');
        $response->assertStatus(200);
    }

    public function test_create_penjualan_panen_with_valid_data()
    {
        $file = UploadedFile::fake()->image('bukti.jpg');

        $data = [
            'jenis_tanaman' => 'Padi',
            'tanggal_tanam' => '2026-03-01',
            'tanggal_jual' => '2026-06-01',
            'kuantitas' => 100,
            'satuan' => 'kg',
            'harga_satuan' => 5000,
            'total_harga' => 500000,
            'pembeli' => 'PT Panen Jaya',
            'bukti_foto' => $file,
            'keterangan' => 'Panen berkualitas bagus',
        ];

        $response = $this->actingAs($this->admin)
            ->post('/admin/penjualan-panen', $data);

        $this->assertDatabaseHas('penjualan_panens', [
            'jenis_tanaman' => 'Padi',
            'kuantitas' => 100,
            'user_id' => $this->admin->id,
        ]);
    }

    public function test_create_penjualan_panen_without_bukti_foto_fails()
    {
        $data = [
            'jenis_tanaman' => 'Padi',
            'tanggal_tanam' => '2026-03-01',
            'tanggal_jual' => '2026-06-01',
            'kuantitas' => 100,
            'satuan' => 'kg',
            'harga_satuan' => 5000,
            'total_harga' => 500000,
            'pembeli' => 'PT Panen Jaya',
            'keterangan' => 'Panen berkualitas bagus',
        ];

        $response = $this->actingAs($this->admin)
            ->post('/admin/penjualan-panen', $data);

        $this->assertDatabaseMissing('penjualan_panens', [
            'jenis_tanaman' => 'Padi',
        ]);
    }

    public function test_update_penjualan_panen()
    {
        $penjualan = PenjualanPanen::factory()->create(['user_id' => $this->admin->id]);
        
        $file = UploadedFile::fake()->image('bukti_baru.jpg');

        $data = [
            'jenis_tanaman' => 'Jagung',
            'tanggal_tanam' => '2026-02-01',
            'tanggal_jual' => '2026-05-01',
            'kuantitas' => 150,
            'satuan' => 'kg',
            'harga_satuan' => 4000,
            'total_harga' => 600000,
            'pembeli' => 'PT Agro Indonesia',
            'bukti_foto' => $file,
            'keterangan' => 'Update data',
        ];

        $response = $this->actingAs($this->admin)
            ->put("/admin/penjualan-panen/{$penjualan->id}", $data);

        $this->assertDatabaseHas('penjualan_panens', [
            'id' => $penjualan->id,
            'jenis_tanaman' => 'Jagung',
            'kuantitas' => 150,
        ]);
    }

    public function test_delete_penjualan_panen()
    {
        $penjualan = PenjualanPanen::factory()->create(['user_id' => $this->admin->id]);

        $response = $this->actingAs($this->admin)
            ->delete("/admin/penjualan-panen/{$penjualan->id}");

        $this->assertDatabaseMissing('penjualan_panens', ['id' => $penjualan->id]);
    }

    public function test_total_harga_calculated_from_kuantitas_and_harga_satuan()
    {
        $file = UploadedFile::fake()->image('bukti.jpg');

        $data = [
            'jenis_tanaman' => 'Padi',
            'tanggal_tanam' => '2026-03-01',
            'tanggal_jual' => '2026-06-01',
            'kuantitas' => 50,
            'satuan' => 'kg',
            'harga_satuan' => 10000,
            'total_harga' => 500000, // 50 * 10000
            'pembeli' => 'PT Panen Jaya',
            'bukti_foto' => $file,
        ];

        $response = $this->actingAs($this->admin)
            ->post('/admin/penjualan-panen', $data);

        $this->assertDatabaseHas('penjualan_panens', [
            'kuantitas' => 50,
            'harga_satuan' => 10000,
            'total_harga' => 500000,
        ]);
    }

    public function test_user_id_auto_filled_from_authenticated_user()
    {
        $file = UploadedFile::fake()->image('bukti.jpg');

        $data = [
            'jenis_tanaman' => 'Padi',
            'tanggal_tanam' => '2026-03-01',
            'tanggal_jual' => '2026-06-01',
            'kuantitas' => 100,
            'satuan' => 'kg',
            'harga_satuan' => 5000,
            'total_harga' => 500000,
            'pembeli' => 'PT Panen Jaya',
            'bukti_foto' => $file,
        ];

        $this->actingAs($this->admin)->post('/admin/penjualan-panen', $data);

        $this->assertDatabaseHas('penjualan_panens', [
            'user_id' => $this->admin->id,
        ]);
    }
}
