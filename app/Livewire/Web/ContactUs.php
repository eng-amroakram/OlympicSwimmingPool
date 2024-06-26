<?php

namespace App\Livewire\Web;

use App\Http\Controllers\Services\Services;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ContactUs extends Component
{
    use LivewireAlert;

    public $name = '';
    public $email = '';
    public $phone = '';
    public $our_service_id = '';
    public $message = '';

    public function render()
    {
        return view('livewire.web.contact-us');
    }

    private function setService()
    {
        return Services::createInstance("ContactUsService") ?? new Services();
    }

    public function submit()
    {
        $service = $this->setService();

        $data = [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "our_service_id" => $this->our_service_id,
            "message" => $this->message,
        ];

        $rules = $service->rules();
        $messages = $service->messages();
        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('create-contact-us-errors', $errors);
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
