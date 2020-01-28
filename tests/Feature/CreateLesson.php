<?php

namespace Tests\Feature;

use App\Series;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLesson extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_create_lessons()
    {
        $this->loginAdmin();
        $this->withoutExceptionHandling();
        $series = factory(Series::class)->create();
        $lesson = [
            "title" => 'new lesson',
            'description' => 'new lesson desc',
            'episode_number' => 23,
            'video_id' => 2222
        ];
        $this->postJson("/admin/{$series->id}/lessons", $lesson)
            ->assertStatus(200)->assertJson($lesson);

        $this->assertDatabaseHas('lessons', [
            'title' => $lesson['title']
        ]);
    }
}
