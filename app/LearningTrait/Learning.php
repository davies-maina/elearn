<?php

namespace App\LearningTrait;

use App\Lesson;
use App\Series;
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
        return count($this->getCompletedLessonsInSeries($series));
    }

    public function getCompletedLessonsInSeries($series)
    {

        return Redis::smembers("user:{$this->id}:series:{$series->id}");
    }

    public function hasStartedSeries($series)
    {
        return $this->getNumberOfFinishedLessonsInSeries($series) > 0;
    }

    public function getCompletedLessons($series)
    {
        /*  $completedLessons = $this->getCompletedLessonsInSeries($series);

        return collect($completedLessons)->map(function ($lesson) {

            return Lesson::find($lesson);
        }); */

        return Lesson::whereIn('id', $this->getCompletedLessonsInSeries($series))->get();
        //this approach will reduce number of queries made to the db, thus improving performance ~Davies
    }

    public function hasCompletedLesson($lesson)
    {
        return in_array($lesson->id, $this->getCompletedLessonsInSeries($lesson->series));
    }
    public function getSeriesBeingWatchedIds()
    {


        $keys = Redis::keys("user:{$this->id}:series:*"); //searching Redis store
        $seriesIdds = [];
        foreach ($keys as $key) :
            $seriesId = explode(':', $key)[3];
            array_push($seriesIdds, $seriesId);
        endforeach;

        return $seriesIdds;
    }

    public function getSeriesBeingWatched()
    {
        /* $keys = Redis::keys("user:{$this->id}:series:*"); */ //searching Redis store
        /* $seriesIdds = [];
        foreach ($keys as $key) :
            $seriesId = explode(':', $key)[3];
            array_push($seriesIdds, $seriesId);
        endforeach; */
        return collect($this->getSeriesBeingWatchedIds())
            ->map(function ($id) {


                return Series::find($id);
            });
    }
}
