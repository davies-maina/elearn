<?php

namespace App\Http\Controllers;

use App\Series;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function welcome()
    {
        $series=Series::all();
        return view('welcome')->withSeries($series);
    }
}
