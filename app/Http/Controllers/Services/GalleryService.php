<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryService extends Controller
{
    public $model = Gallery::class;

    public function __construct()
    {
        $this->model = new Gallery();
    }

    public function model($id)
    {
        return Gallery::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Gallery::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return Gallery::changeStatus($id);
    }

    public function delete($id)
    {
        return Gallery::deleteModel($id);
    }

    public function store($data)
    {
        return Gallery::store($data);
    }

    public function update($data, $id)
    {
        return Gallery::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return Gallery::getRules($id);
    }

    public function messages()
    {
        return Gallery::getMessages();
    }
}
