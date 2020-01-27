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
}
