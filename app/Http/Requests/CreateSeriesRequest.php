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
            //
        ];
    }


    public function uploadSeriesImage()
    {

        $uploadedImage = $this->image;
        $imageName = str_slug($this->title) . '.' . $uploadedImage->getClientOriginalExtension();
        $image = $uploadedImage->storeAs('series', $this->imageName);
        return $this;
    }

    public function storeSeries()
    {

        Series::create([

            'title' => $this->title,
            'description' => $this->description,
            'slug' => str_slug($this->title),
            'image_url' => 'series/' . $this->imageName

        ]);
    }
}
