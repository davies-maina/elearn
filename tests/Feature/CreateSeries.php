<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CreateSeries extends TestCase
{
    use RefreshDatabase;
    public function test_if_user_can_create_series()
    {
        $this->withoutExceptionHandling();
        Storage::fake(config('filesystems.default'));
        $this->post('/admin/series', [

            'title' => 'The merchant',
            'description' => 'super strong',
            'image' => UploadedFile::fake()->image('image-series.png'),
        ])->assertRedirect();

        Storage::disk(config('filesystems.default'))->assertExists('series/' . str_slug('The merchant') . 'png');
    }
}
