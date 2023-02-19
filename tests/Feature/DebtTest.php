<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DebtTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_debts()
    {
        $response = $this->get('/debts');

        $response->assertStatus(302);
    }

    public function test_generate_tickets()
    {
        $response = $this->post('/tickets');

        $response->assertStatus(302);
    }

    public function test_upload_is_valid()
    {
        $file = Storage::get('public/storage/imports');
        $response = $this->post('/upload', [
            'file' => $file,
        ]);

        $response->assertStatus(302);
    }
}
