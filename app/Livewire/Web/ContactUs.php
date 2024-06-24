<?php

namespace App\Livewire\Web;

use Livewire\Component;

class ContactUs extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $our_service_id = '';
    public $message = '';

    public function render()
    {
        return view('livewire.web.contact-us');
    }

    public function submit()
    {
        $data = [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "our_service_id" => $this->our_service_id,
            "message" => $this->message,
        ];

        dd($data);
    }
}
