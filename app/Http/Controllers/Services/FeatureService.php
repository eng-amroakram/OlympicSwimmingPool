<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureService extends Controller
{
    public $model = Feature::class;

    public function __construct()
    {
        $this->model = new Feature();
    }

    public function model($id)
    {
        return Feature::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Feature::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return Feature::changeStatus($id);
    }

    public function delete($id)
    {
        return Feature::deleteModel($id);
    }

    public function store($data)
    {
        return Feature::store($data);
    }

    public function update($data, $id)
    {
        return Feature::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return Feature::getRules($id);
    }

    public function messages()
    {
        return Feature::getMessages();
    }
}
