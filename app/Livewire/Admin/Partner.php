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

class Partner extends Component
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

    public $photo = "";
    public $status = "active";

    public $partner_id = '';

    #[Title('لوحة التحكم - الشركاء'), Layout('layouts.admin.app')]
    public function render()
    {
        $this->filters["search"] = $this->search;
        $this->filters["status"] = $this->search_status;

        $service = $this->setService();
        $partners = $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->pagination);
        $this->resetPage();

        return view('livewire.admin.partner', [
            'partners' => $partners
        ]);
    }

    private function setService()
    {
        return Services::createInstance("PartnerService") ?? new Services();
    }

    public function changeStatus($id)
    {
        $service = $this->setService();
        $result = $service->changeStatus($id);

        if ($result) {
            $this->alertMessage("تم تعديل حالة الصورة بنجاح", 'success');
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
            $this->alertMessage("تم حذف الصورة بنجاح", 'success');
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

    public function addPartner()
    {
        $service = $this->setService();

        $data = [
            "photo" => $this->photo,
            "status" => $this->status ?? "active",
        ];

        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-partner-errors', $errors);
            $this->alertMessage('يرجى التأكد من إدخال البيانات', 'error');
            return false;
        }

        $partner = $service->store($data);

        if ($partner) {
            $this->alertMessage('تم تسجيل البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.partners');
        }

        $this->alertMessage('حدث خطأ اثناء تسجيل بياناتك', 'error');
        return false;
    }

    public function updatePartner()
    {
        $service = $this->setService();

        $data = [
            "photo" => $this->photo,
            "status" => $this->status ?? "active",
        ];

        $rules = $service->rules($this->partner_id);
        unset($rules["photo"][0]);
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-partner-errors', $errors);
            $this->alertMessage('يرجى التأكد من البيانات', 'error');
            return false;
        }

        $result = $service->update($data, $this->partner_id);

        if ($result) {
            $this->alertMessage('تم تحديث البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return redirect()->route('admin.partners');
        }

        $this->alertMessage('حدث خطأ اثناء تحديث البيانات', 'error');
        return false;
    }

    public function edit($id)
    {
        $service = $this->setService();
        $partner = $service->model($id);
        $this->partner_id = $id;

        // $this->photo = $partner->photo;
        $this->status = $partner->status;

        // $this->dispatch('set-partner-status', ["status" => $partner->status]);
    }

    public function resetting()
    {
        $this->reset();
    }
}
