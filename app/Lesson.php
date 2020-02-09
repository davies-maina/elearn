<?php

namespace App;

use App\Series;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    public function series()
    {

        return $this->belongsTo(Series::class);
    }

    public function getNextLesson()
    {

        return $this->series->lessons()->where('episode_number', '>', $this->episode_number)
            ->orderBy('episode_number', 'asc')
            ->first();
    }

    public function getPreviousLesson()
    {



        return $this->series->lessons()->where('episode_number', '<', $this->episode_number)
            ->orderBy('episode_number', 'desc')
            ->first();
    }
}
