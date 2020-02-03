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
        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        /* $series = factory(Series::class)->create(); */
        $lesson = factory(Lesson::class)->create();

        $lesson2 = factory(Lesson::class)->create([

            'series_id' => 1
        ]);

        $user->finishLesson($lesson);
        $user->finishLesson($lesson2);
        $this->assertEquals(

            Redis::smembers('user:1:series:1'),
            [1, 2]
        );
    }
}
