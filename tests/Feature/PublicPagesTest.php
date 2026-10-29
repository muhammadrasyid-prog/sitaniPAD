<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_returns_200()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('SITANI');
    }

    public function test_about_page_returns_200()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSeeText('Tentang Yayasan');
    }

    public function test_program_page_returns_200()
    {
        $response = $this->get('/program');
        $response->assertStatus(200);
        $response->assertSeeText('Program Kerja Yayasan');
    }

    public function test_gallery_page_returns_200()
    {
        $response = $this->get('/gallery');
        $response->assertStatus(200);
        $response->assertSeeText('Galeri Kegiatan');
    }

    public function test_contact_page_returns_200()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSeeText('Hubungi Kami');
    }

    public function test_transparansi_page_returns_200()
    {
        $response = $this->get('/transparansi');
        $response->assertStatus(200);
        $response->assertSeeText('Transparansi Dana Yayasan');
    }

    public function test_navbar_contains_navigation_links()
    {
        $response = $this->get('/');
        $response->assertSeeText('Beranda');
        $response->assertSeeText('Tentang');
        $response->assertSeeText('Program');
        $response->assertSeeText('Galeri');
        $response->assertSeeText('Kontak');
        $response->assertSeeText('Transparansi');
    }
}
