<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\Services\Services;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Sliders extends Component
{
    use WithPagination;
    use LivewireAlert;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $service = null;

    public $search = "";
    public $pagination = 10;
    public $sort_field = 'id';
    public $sort_direction = 'asc'; // desc

    public $filters = [];
    public $search_status = "";

    public $title = '';
    public $sub_title = '';
    public $description = "";
    public $photo = "";
    public $link = "";
    public $status = "active";

    public $slider_id = '';


    private function setService()
    {
        return Services::createInstance("SliderService") ?? new Services();
    }

    #[Title('لوحة التحكم - السلايدرز'), Layout('layouts.admin.app')]
    public function render()
    {
        $this->filters["search"] = $this->search;
        $this->filters["status"] = $this->search_status;

        $service = $this->setService();
        $sliders = $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->pagination);
        $this->resetPage();

        return view('livewire.admin.sliders', [
            'sliders' => $sliders
        ]);
    }

    public function changeStatus($id)
    {
        $service = $this->setService();
        $result = $service->changeStatus($id);

        if ($result) {
            $this->alertMessage("تم تعديل حالة السلايدر بنجاح", 'success');
            return true;
        }

        $this->alertMessage("حدث خطأ يرجى المحاولة مرة اخرى", 'error');
        return false;
    }

    public function delete($id)
    {
        $service = $this->setService();
        $result = $service->delete($id);
        if ($result) {
            $this->alertMessage("تم حذف السلايدر بنجاح", 'success');
            return true;
        }
        $this->alertMessage("حدث خطأ يرجى المحاولة مرة اخرى", 'error');
        return false;
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'top-start',
            'timer' => 3000,
            'text' => $message,
            'timerProgressBar' => true,
        ]);
    }

    public function addSlider()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            "sub_title" => $this->sub_title,
            "description" => $this->description,
            "photo" => $this->photo,
            "link" => $this->link,
            "status" => $this->status ?? "active",
        ];

        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-slider-errors', $errors);
            $this->alertMessage('يرجى التأكد من إدخال البيانات', 'error');
            return false;
        }

        $center = $service->store($data);

        if ($center) {
            $this->alertMessage('تم تسجيل البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.sliders');
        }

        $this->alertMessage('حدث خطأ اثناء تسجيل بياناتك', 'error');
        return false;
    }

    public function updateSlider()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            "sub_title" => $this->sub_title,
            "description" => $this->description,
            "photo" => $this->photo,
            "link" => $this->link,
            "status" => $this->status ?? "active",
        ];

        $rules = $service->rules($this->slider_id);
        unset($rules["photo"][0]);
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-slider-errors', $errors);
            $this->alertMessage('يرجى التأكد من البيانات', 'error');
            return false;
        }

        $result = $service->update($data, $this->slider_id);

        if ($result) {
            $this->alertMessage('تم تحديث البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.sliders');

        }

        $this->alertMessage('حدث خطأ اثناء تحديث البيانات', 'error');
        return false;
    }

    public function edit($id)
    {
        $service = $this->setService();
        $slider = $service->model($id);
        $this->slider_id = $id;

        $this->title = $slider->title;
        $this->sub_title = $slider->sub_title;
        $this->description = $slider->description;
        $this->link = $slider->link;
        // $this->photo = $slider->photo;
        $this->status = $slider->status;

        // $this->dispatch('set-slider-status', ["status" => $slider->status]);
    }

    public function resetting()
    {
        $this->reset();
    }
}
