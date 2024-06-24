<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Partner;

class PartnerService extends Controller
{
    public $model = Partner::class;

    public function __construct()
    {
        $this->model = new Partner();
    }

    public function model($id)
    {
        return Partner::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Partner::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return Partner::changeStatus($id);
    }

    public function delete($id)
    {
        return Partner::deleteModel($id);
    }

    public function store($data)
    {
        return Partner::store($data);
    }

    public function update($data, $id)
    {
        return Partner::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return Partner::getRules($id);
    }

    public function messages()
    {
        return Partner::getMessages();
    }
}
