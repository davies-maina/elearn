<?php

namespace App\Http\Controllers;

use App\Series;
use App\Lesson;
use Illuminate\Http\Request;

class WatchSeriesController extends Controller
{
    public function index(Series $series)
    {
        return redirect()->route(
            'series.watch',
            [
                'series' => $series->slug,
                'lesson' => $series->lessons()->first()->id
            ]
        );
    }

    public function showLesson(Series $series, Lesson $lesson)
    {
        return view('watch', [

            'series' => $series,
            'lesson' => $lesson
        ]);
    }

    public function completeLesson(Lesson $lesson)
    {
        auth()->user()->finishLesson($lesson);
        return response()->json([

            'status' => 'ok'
        ]);
    }
}
