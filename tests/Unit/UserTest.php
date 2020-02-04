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

        $this->assertEquals(

            $user->getNumberOfFinishedLessonsInSeries($lesson->series),
            2
        );
    }

    public function test_percentage_completed_series_for_user()
    {

        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        /* $series = factory(Series::class)->create(); */
        $lesson = factory(Lesson::class)->create();
        factory(Lesson::class)->create(['series_id' => 1]);
        factory(Lesson::class)->create(['series_id' => 1]);

        $lesson2 = factory(Lesson::class)->create([

            'series_id' => 1
        ]);

        $user->finishLesson($lesson);
        $user->finishLesson($lesson2);

        $this->assertEquals(

            $user->percentageSeriesCompleted($lesson->series),
            50
        );
    }

    public function test_can_know_a_user_has_started_a_series()
    {
        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        /* $series = factory(Series::class)->create(); */
        $lesson = factory(Lesson::class)->create();
        factory(Lesson::class)->create(['series_id' => 1]);
        factory(Lesson::class)->create(['series_id' => 1]);

        $lesson2 = factory(Lesson::class)->create([

            'series_id' => 1
        ]);
        $lesson3 = factory(Lesson::class)->create();
        $user->finishLesson($lesson2);
        $this->assertTrue($user->hasStartedSeries($lesson->series));
        $this->assertFalse($user->hasStartedSeries($lesson3->series));
    }
}
