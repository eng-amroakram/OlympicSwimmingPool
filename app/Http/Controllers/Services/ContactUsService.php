<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsService extends Controller
{
    public $model = ContactUs::class;

    public function __construct()
    {
        $this->model = new ContactUs();
    }

    public function model($id)
    {
        return ContactUs::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return ContactUs::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function changeStatus($id)
    {
        return ContactUs::changeStatus($id);
    }

    public function delete($id)
    {
        return ContactUs::deleteModel($id);
    }

    public function store($data)
    {
        return ContactUs::store($data);
    }

    public function update($data, $id)
    {
        return ContactUs::updateModel($data, $id);
    }

    public function rules($id = "")
    {
        return ContactUs::getRules($id);
    }

    public function messages()
    {
        return ContactUs::getMessages();
    }
}
