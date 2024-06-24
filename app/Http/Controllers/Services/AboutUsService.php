<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsService extends Controller
{
    public $model = AboutUs::class;

    public function __construct()
    {
        $this->model = new AboutUs();
    }

    public function model($id)
    {
        return AboutUs::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return AboutUs::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return AboutUs::changeStatus($id);
    }

    public function delete($id)
    {
        return AboutUs::deleteModel($id);
    }

    public function store($data)
    {
        return AboutUs::store($data);
    }

    public function update($data, $id)
    {
        return AboutUs::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return AboutUs::getRules($id);
    }

    public function messages()
    {
        return AboutUs::getMessages();
    }
}
