<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\OurService;
use Illuminate\Http\Request;

class OurServicesService extends Controller
{
    public $model = OurService::class;

    public function __construct()
    {
        $this->model = new OurService();
    }

    public function model($id)
    {
        return OurService::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return OurService::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return OurService::changeStatus($id);
    }

    public function delete($id)
    {
        return OurService::deleteModel($id);
    }

    public function store($data)
    {
        return OurService::store($data);
    }

    public function update($data, $id)
    {
        return OurService::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return OurService::getRules($id);
    }

    public function messages()
    {
        return OurService::getMessages();
    }
}
