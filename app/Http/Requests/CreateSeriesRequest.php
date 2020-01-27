<?php

namespace App\Http\Requests;

use App\Series;
use Illuminate\Foundation\Http\FormRequest;

class CreateSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ];
    }


    /* public function uploadSeriesImage()
    {

        $uploadedImage = $this->image;
        $imageName = str_slug($this->title) . '.' . $uploadedImage->getClientOriginalExtension();
        $image = $uploadedImage->storePubliclyAs('series', $this->imageName);
        return $this;
    }

    public function storeSeries()
    {

        $series = Series::create([

            'title' => $this->title,
            'description' => $this->description,
            'slug' => str_slug($this->title),
            'image_url' => 'series/' . $this->imageName

        ]);
        request()->session()->flash('success', 'series created successfully');
        return redirect()->route('series.show', $series->id);
    } */
}
