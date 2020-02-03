<?php

namespace Tests\Unit;

use App\User;
use App\Lesson;
use App\Series;
use Tests\TestCase;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_finish_lesson()
    {

        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $series = factory(Series::class)->create();
        $lesson = factory(Lesson::class)->create([

            'series_id' => $series->id
        ]);

        $user->finishLesson($lesson);
        $this->assertEquals(

            Redis::smembers('user:1:series:1'),
            [1]
        );
    }
}
