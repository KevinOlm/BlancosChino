<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MailForm extends Component
{
    public $name;
    public $subject;
    public $email;
    public $message;
    public $disabled = true;

    protected $rules = [
        'name' => 'required|max:100',
        'subject' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ];

    public function updated() {
        $this->disabled = true;
        $this->validate();

        $this->disabled = false;
    }

    public function render()
    {
        return view('livewire.mail-form');
    }
}