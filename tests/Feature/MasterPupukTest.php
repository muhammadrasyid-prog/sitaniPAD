<?php

namespace Tests\Feature;

use App\Models\MasterPupuk;
use App\Models\PupukMasuk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MasterPupukTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    public function test_master_pupuk_index_page_returns_200()
    {
        $response = $this->actingAs($this->admin)->get('/admin/master-pupuk');
        $response->assertStatus(200);
    }

    public function test_create_master_pupuk_with_valid_data()
    {
        $data = [
            'kode_pupuk' => 'PK001',
            'nama_pupuk' => 'Urea',
            'jenis_kandungan' => 'Nitrogen',
            'satuan' => 'kg',
        ];

        $this->actingAs($this->admin)
            ->post('/admin/master-pupuk', $data);

        $this->assertDatabaseHas('master_pupuks', [
            'kode_pupuk' => 'PK001',
            'nama_pupuk' => 'Urea',
        ]);
    }

    public function test_create_master_pupuk_with_duplicate_kode_fails()
    {
        MasterPupuk::create([
            'kode_pupuk' => 'PK001',
            'nama_pupuk' => 'Urea',
            'satuan' => 'kg',
        ]);

        $data = [
            'kode_pupuk' => 'PK001', // Duplicate
            'nama_pupuk' => 'Pupuk Urea Baru',
            'satuan' => 'kg',
        ];

        $response = $this->actingAs($this->admin)
            ->post('/admin/master-pupuk', $data);

        // Should fail validation
        $this->assertDatabaseCount('master_pupuks', 1);
    }

    public function test_update_master_pupuk()
    {
        $pupuk = MasterPupuk::factory()->create();

        $data = [
            'kode_pupuk' => $pupuk->kode_pupuk,
            'nama_pupuk' => 'Urea Premium',
            'jenis_kandungan' => 'Nitrogen Tinggi',
            'satuan' => 'kg',
        ];

        $this->actingAs($this->admin)
            ->put("/admin/master-pupuk/{$pupuk->id}", $data);

        $this->assertDatabaseHas('master_pupuks', [
            'id' => $pupuk->id,
            'nama_pupuk' => 'Urea Premium',
        ]);
    }

    public function test_delete_master_pupuk_succeeds_if_not_referenced()
    {
        $pupuk = MasterPupuk::factory()->create();

        $this->actingAs($this->admin)
            ->delete("/admin/master-pupuk/{$pupuk->id}");

        $this->assertDatabaseMissing('master_pupuks', ['id' => $pupuk->id]);
    }

    public function test_delete_master_pupuk_fails_if_referenced_by_pupuk_masuk()
    {
        $pupuk = MasterPupuk::factory()->create();
        $user = User::factory()->create();

        // Create referencing record
        PupukMasuk::factory()->create([
            'pupuk_id' => $pupuk->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->delete("/admin/master-pupuk/{$pupuk->id}");

        // Record should still exist
        $this->assertDatabaseHas('master_pupuks', ['id' => $pupuk->id]);
    }

    public function test_master_pupuk_shows_searchable_columns()
    {
        MasterPupuk::factory()->create([
            'kode_pupuk' => 'PK001',
            'nama_pupuk' => 'Urea',
        ]);

        MasterPupuk::factory()->create([
            'kode_pupuk' => 'PK002',
            'nama_pupuk' => 'Fosfat',
        ]);

        $response = $this->actingAs($this->admin)
            ->get('/admin/master-pupuk');

        $response->assertStatus(200);
        $response->assertSeeText('Urea');
        $response->assertSeeText('Fosfat');
    }
}
