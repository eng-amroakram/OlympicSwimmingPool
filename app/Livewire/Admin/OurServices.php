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

class OurServices extends Component
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

    public $our_services_id = null;

    public $title = "";
    public $photo = "";
    public $description = "";
    public $status = "active";

    #[Title('لوحة التحكم - خدماتنا'), Layout('layouts.admin.app')]
    public function render()
    {
        $this->filters["search"] = $this->search;
        $this->filters["status"] = $this->search_status;

        $service = $this->setService();
        $our_services = $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->pagination);
        $this->resetPage();

        return view('livewire.admin.our-services', [
            'our_services' => $our_services
        ]);
    }

    private function setService()
    {
        return Services::createInstance("OurServicesService") ?? new Services();
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

    public function addOurServices()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            'photo' => $this->photo,
            "description" => $this->description,
            "status" => $this->status,
        ];

        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-our-services-errors', $errors);
            $this->alertMessage('يرجى التأكد من إدخال البيانات', 'error');
            return false;
        }

        $our_services = $service->store($data);

        if ($our_services) {
            $this->alertMessage('تم تسجيل البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.our-services');
        }

        $this->alertMessage('حدث خطأ اثناء تسجيل بياناتك', 'error');
        return false;
    }

    public function updateOurServices()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            'photo' => $this->photo,
            "description" => $this->description,
            "status" => $this->status,
        ];

        $rules = $service->rules($this->our_services_id);
        unset($rules["photo"][0]);
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-our-services-errors', $errors);
            $this->alertMessage('يرجى التأكد من البيانات', 'error');
            return false;
        }

        $result = $service->update($data, $this->our_services_id);

        if ($result) {
            $this->alertMessage('تم تحديث البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.our-services');
        }

        $this->alertMessage('حدث خطأ اثناء تحديث البيانات', 'error');
        return false;
    }

    public function edit($id)
    {
        $service = $this->setService();
        $our_services = $service->model($id);
        $this->our_services_id = $id;

        $this->title = $our_services->title;
        // $this->photo = $our_services->photo;
        $this->description = $our_services->description;

        // $this->dispatch('set-about-us-features', ["features" => $about_us->features]);
    }

    public function resetting()
    {
        $this->reset();
    }
}
