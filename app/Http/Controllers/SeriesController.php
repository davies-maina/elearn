<?php

namespace App\Http\Controllers;

use App\Series;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSeriesRequest;
use App\Http\Requests\EditSeriesReq;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::all();
        return view('admin.series.all')->withSeries($series);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSeriesRequest $request)
    {
        $uploadedImage = $request->image;
        $imageName = str_slug($request->title) . '.' . $uploadedImage->getClientOriginalExtension();
        $image = $uploadedImage->storePubliclyAs('series', $imageName);

        $series = Series::create([

            'title' => $request->title,
            'description' => $request->description,
            'slug' => str_slug($request->title),
            'image_url' => 'series/' . $imageName

        ]);
        request()->session()->flash('success', 'series created successfully');
        return redirect()->route('series.show', $series->slug);
        /* $request->uploadSeriesImage()->storeSeries(); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        /* dd($series); */
        return view('admin.series.index')->withSeries($series);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        return view('admin.series.edit')->withSeries($series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSeriesReq $request, Series $series)
    {
        /* dd($request->all()); */
        if ($request->hasFile('image')) {
            $uploadedImage = $request->image;
            $imageName = str_slug($request->title) . '.' . $uploadedImage->getClientOriginalExtension();
            $series->image_url = $image = $uploadedImage->storePubliclyAs('series', $imageName);
        }

        /*  $series = [

            'title' => $request->title,
            'description' => $request->description,
            'slug' => str_slug($request->title),
            'image_url' => 'series/' . $imageName
        ]; */

        $series->title = $request->title;
        $series->description = $request->description;
        $series->slug = str_slug($request->title);

        $series->save();

        return redirect()->route('series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
