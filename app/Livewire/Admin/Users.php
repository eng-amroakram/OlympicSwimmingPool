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

class Users extends Component
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
    public $search_type = null;
    public $search_status = null;

    public $name = "";
    public $email = "";
    public $phone = "";
    public $password = "";
    public $type = "employee";
    public $status = "active";

    private function setService()
    {
        return Services::createInstance("UserService") ?? new Services();
    }

    #[Title('لوحة التحكم - المستخدمين'), Layout('layouts.admin.app')]
    public function render()
    {
        $this->filters["search"] = $this->search;
        $this->filters["type"] = $this->search_type;
        $this->filters["status"] = $this->search_status;

        $service = $this->setService();
        $users = $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->pagination);
        $this->resetPage();

        return view('livewire.admin.users', [
            'users_models' => $users
        ]);
    }

    public function changeAccountStatus($id)
    {
        $service = $this->setService();
        $message = $service->changeAccountStatus($id);
        if ($message) {
            $this->alertMessage($message, 'success');
        } else {
            $this->alertMessage("حدث خطأ يرجى المحاولة مرة اخرى", 'error');
        }
    }

    public function delete($id)
    {
        $service = $this->setService();
        $message = $service->delete($id);
        $this->alertMessage($message, 'success');
    }

    public function addUser()
    {
        $service = $this->setService();

        $data = [
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "type" => $this->type,
            "status" => $this->status,
        ];

        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-new-user-errors', $errors);
            $this->alertMessage('يرجى التأكد من إدخال البيانات', 'error');
            return false;
        }

        $user = $service->store($data);

        if ($user) {
            $this->alertMessage('تم تسجيل البيانات بنجاح', 'success');
            $this->dispatch('process-has-been-done');
            $this->reset();
            return true;
        }

        $this->alertMessage('حدث خطأ اثناء تسجيل بياناتك', 'error');
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
}
