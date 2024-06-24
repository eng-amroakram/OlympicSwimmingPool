<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderService extends Controller
{
    public $model = Slider::class;

    public function __construct()
    {
        $this->model = new Slider();
    }

    public function model($id)
    {
        return Slider::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Slider::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return Slider::changeStatus($id);
    }

    public function delete($id)
    {
        return Slider::deleteModel($id);
    }

    public function store($data)
    {
        return Slider::store($data);
    }

    public function update($data, $id)
    {
        return Slider::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return Slider::getRules($id);
    }

    public function messages()
    {
        return Slider::getMessages();
    }
}
