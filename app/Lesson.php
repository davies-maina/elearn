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

        $nextLesson = $this->series->lessons()->where('episode_number', '>', $this->episode_number)
            ->orderBy('episode_number', 'asc')
            ->first();

        if ($nextLesson) {
            return $nextLesson;
        }

        return $this;
    }

    public function getPreviousLesson()
    {



        $previousLesson = $this->series->lessons()->where('episode_number', '<', $this->episode_number)
            ->orderBy('episode_number', 'desc')
            ->first();

        if ($previousLesson) {
            return $previousLesson;
        }

        return $this;
    }
}
