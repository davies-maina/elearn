<?php

namespace Tests\Feature;

use App\User;
use App\Lesson;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CreateSeries extends TestCase
{
    use RefreshDatabase;
    public function test_if_user_can_create_series()
    {
        $this->withoutExceptionHandling();
        $this->loginAdmin();
        Storage::fake(config('filesystems.default'));
        $this->post('/admin/series', [

            'title' => 'The merchant',
            'description' => 'super strong',
            'image' => UploadedFile::fake()->image('image-series.png'),
        ])->assertRedirect()->assertSessionHas('success', 'series created successfully');

        Storage::disk(config('filesystems.default'))->assertExists('series/' . str_slug('The merchant') . 'png');
    }

    public function test_a_series_must_be_created_with_title()
    {
        $this->loginAdmin();
        /* $this->withoutExceptionHandling(); */
        $this->post('/admin/series', [

            /* 'title' => 'The merchant', */
            'description' => 'super strong',
            'image' => UploadedFile::fake()->image('image-series.png'),
        ])->assertSessionHasErrors('title');
    }

    public function test_a_series_must_be_created_with_description()
    {
        $this->loginAdmin();
        /* $this->withoutExceptionHandling(); */
        $this->post('/admin/series', [

            'title' => 'The merchant',
            /*  'description' => 'super strong', */
            'image' => UploadedFile::fake()->image('image-series.png'),
        ])->assertSessionHasErrors('description');
    }

    public function test_a_series_must_be_created_with_image()
    {
        $this->loginAdmin();
        /* $this->withoutExceptionHandling(); */
        $this->post('/admin/series', [

            'title' => 'The merchant',
            'description' => 'super strong',
            /* 'image' => UploadedFile::fake()->image('image-series.png'), */
        ])->assertSessionHasErrors('image');
    }

    public function test_a_series_must_be_created_with_an_actual_image()
    {
        $this->loginAdmin();
        /* $this->withoutExceptionHandling(); */
        $this->post('/admin/series', [

            'title' => 'The merchant',
            'description' => 'super strong',
            'image' => 'STRING_INVALID_IMAGE',
        ])->assertSessionHasErrors('image');
    }

    public function test_only_admin_can_create_series()
    {

        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->post('admin/series')->assertSessionHas('error', 'You are not allowed to perform this action');
    }

    public function test_can_get_ordered_lessons_for_a_series()
    {
        $lesson = factory(Lesson::class)->create([
            'episode_number' => 200
        ]);
        $lesson2 = factory(Lesson::class)->create([
            'episode_number' => 100,
            'series_id' => 1
        ]);
        $lesson3 = factory(Lesson::class)->create([
            'episode_number' => 300,
            'series_id' => 1
        ]);

        $lessons = $lesson->series->getOrderedLessons();

        $this->assertInstanceOf(Lesson::class, $lessons->random());

        $this->assertEquals($lessons->first()->id, $lesson2->id);
        $this->assertEquals($lessons->last()->id, $lesson3->id);
    }
}
