<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsService extends Controller
{
    public $model = Settings::class;

    public function __construct()
    {
        $this->model = new Settings();
    }

    public function model($id)
    {
        return Settings::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Settings::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return Settings::changeStatus($id);
    }

    public function delete($id)
    {
        return Settings::deleteModel($id);
    }

    public function store($data)
    {
        return Settings::store($data);
    }

    public function update($data, $id)
    {
        return Settings::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return Settings::getRules($id);
    }

    public function messages()
    {
        return Settings::getMessages();
    }
}
