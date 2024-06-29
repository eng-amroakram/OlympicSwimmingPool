<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogService extends Controller
{
    public $model = Blog::class;

    public function __construct()
    {
        $this->model = new Blog();
    }

    public function model($id)
    {
        return Blog::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Blog::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return Blog::changeStatus($id);
    }

    public function delete($id)
    {
        return Blog::deleteModel($id);
    }

    public function store($data)
    {
        return Blog::store($data);
    }

    public function update($data, $id)
    {
        return Blog::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return Blog::getRules($id);
    }

    public function messages()
    {
        return Blog::getMessages();
    }
}
