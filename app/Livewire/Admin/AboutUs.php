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

class AboutUs extends Component
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

    public $title = "";
    public $features = [];
    public $video_link = "";
    public $status = "active";

    public $about_us_id = null;

    #[Title('لوحة التحكم - حولنا'), Layout('layouts.admin.app')]
    public function render()
    {
        $this->filters["search"] = $this->search;
        $this->filters["status"] = $this->search_status;

        $service = $this->setService();
        $about_uses = $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->pagination);
        $this->resetPage();

        return view('livewire.admin.about-us', [
            'about_uses' => $about_uses
        ]);
    }

    private function setService()
    {
        return Services::createInstance("AboutUsService") ?? new Services();
    }

    public function changeStatus($id)
    {
        $service = $this->setService();
        $result = $service->changeStatus($id);
        if ($result) {
            $this->alertMessage("تم تعديل الحالة بنجاح", 'success');
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
            $this->alertMessage("تم الحذف بنجاح", 'success');
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

    public function addAboutUs()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            'features' => json_encode($this->features),
            "video_link" => $this->video_link,
            "status" => $this->status,
        ];
        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-about-us-errors', $errors);
            $this->alertMessage('يرجى التأكد من إدخال البيانات', 'error');
            return false;
        }

        $about_us = $service->store($data);


        if ($about_us) {
            $this->alertMessage('تم تسجيل البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.about-us');
        }

        $this->alertMessage('حدث خطأ اثناء تسجيل بياناتك', 'error');
        return false;
    }

    public function updateAboutUs()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            'features' => json_encode($this->features),
            "video_link" => $this->video_link,
            "status" => $this->status,
        ];

        $rules = $service->rules($this->about_us_id);
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-feature-errors', $errors);
            $this->alertMessage('يرجى التأكد من البيانات', 'error');
            return false;
        }

        $result = $service->update($data, $this->about_us_id);

        if ($result) {
            $this->alertMessage('تم تحديث البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.about-us');
        }

        $this->alertMessage('حدث خطأ اثناء تحديث البيانات', 'error');
        return false;
    }

    public function edit($id)
    {
        $service = $this->setService();
        $about_us = $service->model($id);
        $this->about_us_id = $id;

        $this->title = $about_us->title;
        $this->features = $about_us->features;
        $this->video_link = $about_us->video_link;
        $this->status = $about_us->status;

        $this->dispatch('set-about-us-features', ["features" => $about_us->features]);
    }

    public function resetting()
    {
        $this->reset();
    }
}
