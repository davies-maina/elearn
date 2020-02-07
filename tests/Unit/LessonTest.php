<?php

namespace Tests\Unit;

use App\Lesson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_get_next_and_previous_lessons()
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


        $this->assertEquals($lesson->getNextLesson()->id, $lesson3->id);
        $this->assertEquals($lesson3->getPreviousLesson()->id, $lesson->id);
        $this->assertEquals($lesson2->getNextLesson()->id, $lesson->id);
        $this->assertNull($lesson2->getPreviousLesson());
        $this->assertNull($lesson3->getNextLesson());
    }
}
