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

class Location extends Component
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
    public $address = "";
    public $phone = "";
    public $email = "";
    public $facebook = "";
    public $instagram = "";
    public $twitter = "";
    public $snap_chat = "";
    public $tiktok = "";
    public $status = "active";

    public $location_id = "";

    #[Title('لوحة التحكم - الموقع'), Layout('layouts.admin.app')]
    public function render()
    {
        $this->filters["search"] = $this->search;
        $this->filters["status"] = $this->search_status;

        $service = $this->setService();
        $locations = $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->pagination);
        $this->resetPage();

        return view('livewire.admin.location', [
            'locations' => $locations
        ]);
    }

    private function setService()
    {
        return Services::createInstance("LocationService") ?? new Services();
    }

    public function changeStatus($id)
    {
        $service = $this->setService();
        $result = $service->changeStatus($id);
        if ($result) {
            $this->alertMessage("تم تعديل حالة الميزة بنجاح", 'success');
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
            $this->alertMessage("تم حذف الميزة بنجاح", 'success');
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

    public function addLocation()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            "address" => $this->address,
            "phone" => $this->phone,
            "email" => $this->email,
            "facebook" => $this->facebook,
            "instagram" => $this->instagram,
            "twitter" => $this->twitter,
            "snap_chat" => $this->snap_chat,
            "tiktok" => $this->tiktok,
            "status" => $this->status,
        ];

        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-location-errors', $errors);
            $this->alertMessage('يرجى التأكد من إدخال البيانات', 'error');
            return false;
        }

        $location = $service->store($data);


        if ($location) {
            $this->alertMessage('تم تسجيل البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.locations');
        }

        $this->alertMessage('حدث خطأ اثناء تسجيل بياناتك', 'error');
        return false;
    }

    public function updateLocation()
    {
        $service = $this->setService();

        $data = [
            "title" => $this->title,
            "address" => $this->address,
            "phone" => $this->phone,
            "email" => $this->email,
            "facebook" => $this->facebook,
            "instagram" => $this->instagram,
            "twitter" => $this->twitter,
            "snap_chat" => $this->snap_chat,
            "tiktok" => $this->tiktok,
            "status" => $this->status,
        ];

        $rules = $service->rules($this->location_id);
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-location-errors', $errors);
            $this->alertMessage('يرجى التأكد من البيانات', 'error');
            return false;
        }

        $result = $service->update($data, $this->location_id);

        if ($result) {
            $this->alertMessage('تم تحديث البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.locations');
        }

        $this->alertMessage('حدث خطأ اثناء تحديث البيانات', 'error');
        return false;
    }

    public function edit($id)
    {
        $service = $this->setService();
        $location = $service->model($id);
        $this->location_id = $id;

        $this->title = $location->title;
        $this->address = $location->address;
        $this->phone = $location->phone;
        $this->email = $location->email;
        $this->facebook = $location->facebook;
        $this->instagram = $location->instagram;
        $this->twitter = $location->twitter;
        $this->snap_chat = $location->snap_chat;
        $this->tiktok = $location->tiktok;

        // $this->dispatch('set-feature-status', ["status" => $feature->status]);
    }

    public function resetting()
    {
        $this->reset();
    }
}
