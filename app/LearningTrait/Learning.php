<?php

namespace App\LearningTrait;

use Illuminate\Support\Facades\Redis;


trait Learning
{
    public function finishLesson($lesson)
    {
        /* dd("user:{$this->id}:series{$lesson->series->id}"); */
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id); //adding to a set
    }



    public function percentageSeriesCompleted($series)
    {

        $numberOfLessonsInSeries = $series->lessons->count();
        $numberOfFinishedLessons = $this->getNumberOfFinishedLessonsInSeries($series);
        return ($numberOfFinishedLessons / $numberOfLessonsInSeries) * 100;
    }

    public function getNumberOfFinishedLessonsInSeries($series)
    {

        /*  return count(Redis::smembers("user:{$this->id}:series:{$series->id}")); */
        return count(Redis::smembers("user:{$this->id}:series:{$series->id}"));
    }

    public function hasStartedSeries($series)
    {
        return $this->getNumberOfFinishedLessonsInSeries($series) > 0;
    }
}
