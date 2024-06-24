<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationService extends Controller
{
    public $model = Location::class;

    public function __construct()
    {
        $this->model = new Location();
    }

    public function model($id)
    {
        return Location::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Location::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return Location::changeStatus($id);
    }

    public function delete($id)
    {
        return Location::deleteModel($id);
    }

    public function store($data)
    {
        return Location::store($data);
    }

    public function update($data, $id)
    {
        return Location::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return Location::getRules($id);
    }

    public function messages()
    {
        return Location::getMessages();
    }
}
