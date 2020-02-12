<?php

namespace Tests\Unit;

use App\User;
use App\Lesson;
use App\Series;
use Tests\TestCase;
use Illuminate\Support\Collection;
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

    public function test_can_get_completed_lessons_in_a_series()
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

        $user->finishLesson($lesson);
        $user->finishLesson($lesson2);
        $completedLessons = $user->getCompletedLessons($lesson->series);

        $this->assertInstanceOf(Collection::class, $completedLessons);
        $this->assertInstanceOf(Lesson::class, $completedLessons->random());
        $completedLessonsIds = $completedLessons->pluck('id')->all();
        $this->assertTrue(in_array($lesson->id, $completedLessonsIds));
        $this->assertTrue(in_array($lesson2->id, $completedLessonsIds));
        $this->assertFalse(in_array($lesson3->id, $completedLessonsIds, $lesson3->id));
    }

    public function test_can_check_if_user_has_completed_lesson()
    {
        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        /* $series = factory(Series::class)->create(); */
        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create(['series_id' => 1]);
        $user->finishLesson($lesson);
        $this->assertTrue($user->hasCompletedLesson($lesson));
        $this->assertFalse($user->hasCompletedLesson($lesson2));
    }
    public function test_can_get_all_series_watched_by_user()
    {

        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson3 = factory(Lesson::class)->create();
        $lesson4 = factory(Lesson::class)->create(['series_id' => 2]);
        $lesson5 = factory(Lesson::class)->create();
        $lesson6 = factory(Lesson::class)->create(['series_id' => 3]);
        $user->finishLesson($lesson);
        $user->finishLesson($lesson3);

        $startedSeries = $user->getSeriesBeingWatched();
        $this->assertInstanceOf(Collection::class, $startedSeries);
        $this->assertInstanceOf(Series::class, $startedSeries->random());
        $idsOfStaredSeries = $startedSeries->pluck('id')->all();
        $this->assertTrue(in_array($lesson->series->id, $idsOfStaredSeries));
        $this->assertTrue(in_array($lesson3->series->id, $idsOfStaredSeries));
        $this->assertFalse(in_array($lesson6->series->id, $idsOfStaredSeries));
    }

    public function test_can_get_number_of_lessons_completed_by_user()
    {
        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson3 = factory(Lesson::class)->create();
        $lesson4 = factory(Lesson::class)->create(['series_id' => 2]);
        $lesson5 = factory(Lesson::class)->create(['series_id' => 2]);
        $user->finishLesson($lesson);
        $user->finishLesson($lesson3);
        $user->finishLesson($lesson5);

        $this->assertEquals(3, $user->getNumberOfCompletedLessons());
    }
}
