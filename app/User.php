<?php

namespace App;

use Illuminate\Support\Facades\Redis;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'confirm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isConfirmed()
    {

        return $this->confirm_token == null;
    }

    public function confirm()
    {
        $this->confirm_token = null;
        $this->save();
    }

    public function isAdmin()
    {
        return in_array($this->email, config('elearn.administrators'));
    }

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
}
