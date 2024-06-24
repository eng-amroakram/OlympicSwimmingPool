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

class Settings extends Component
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

    public $website_name = "";
    public $day_from = "";
    public $day_to = "";
    public $time_from = "";
    public $time_to = "";
    public $photo = "";
    public $status = "active";

    public $settings_id = '';

    #[Title('لوحة التحكم - الاعدادت العامة'), Layout('layouts.admin.app')]
    public function render()
    {
        $this->filters["search"] = $this->search;
        $this->filters["status"] = $this->search_status;

        $service = $this->setService();
        $settings = $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->pagination);
        $this->resetPage();

        return view('livewire.admin.settings', [
            'settings' => $settings
        ]);
    }

    private function setService()
    {
        return Services::createInstance("SettingsService") ?? new Services();
    }

    public function changeStatus($id)
    {
        $service = $this->setService();
        $result = $service->changeStatus($id);

        if ($result) {
            $this->alertMessage("تم تعديل حالة الاعدادات بنجاح", 'success');
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
            $this->alertMessage("تم حذف الاعدادات بنجاح", 'success');
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

    public function addSettings()
    {
        $service = $this->setService();

        $data = [
            "website_name" => $this->website_name,
            "day_from" => $this->day_from,
            "day_to" => $this->day_to,
            "time_from" => $this->time_from,
            "time_to" => $this->time_to,
            "photo" => $this->photo,
            "status" => $this->status ?? "active",
        ];

        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-settings-errors', $errors);
            $this->alertMessage('يرجى التأكد من إدخال البيانات', 'error');
            return false;
        }

        $gallery = $service->store($data);

        if ($gallery) {
            $this->alertMessage('تم تسجيل البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.settings');
        }

        $this->alertMessage('حدث خطأ اثناء تسجيل بياناتك', 'error');
        return false;
    }

    public function updateSettings()
    {
        $service = $this->setService();

        $data = [
            "website_name" => $this->website_name,
            "day_from" => $this->day_from,
            "day_to" => $this->day_to,
            "time_from" => $this->time_from,
            "time_to" => $this->time_to,
            "photo" => $this->photo,
            "status" => $this->status ?? "active",
        ];

        $rules = $service->rules($this->settings_id);
        unset($rules["photo"][0]);
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-settings-errors', $errors);
            $this->alertMessage('يرجى التأكد من البيانات', 'error');
            return false;
        }

        $result = $service->update($data, $this->settings_id);

        if ($result) {
            $this->alertMessage('تم تحديث البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.settings');
        }

        $this->alertMessage('حدث خطأ اثناء تحديث البيانات', 'error');
        return false;
    }

    public function edit($id)
    {
        $service = $this->setService();
        $settings = $service->model($id);
        $this->settings_id = $id;

        $this->website_name = $settings->website_name;
        $this->day_from = $settings->day_from;
        $this->day_to = $settings->day_to;
        $this->time_from = $settings->time_from;
        $this->time_to = $settings->time_to;

        $this->status = $settings->status;

        $this->dispatch('set-settings-day_from', ["day_from" => $settings->day_from]);
        $this->dispatch('set-settings-day_to', ["day_to" => $settings->day_to]);
        $this->dispatch('set-settings-time_from', ["time_from" => $settings->time_from]);
        $this->dispatch('set-settings-time_to', ["time_to" => $settings->time_to]);
    }

    public function resetting()
    {
        $this->reset();
    }
}
