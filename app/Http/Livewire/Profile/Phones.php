<?php

namespace App\Http\Livewire\Profile;

use App\Models\PhoneNumber;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Phones extends Component
{
    public $userPhones;
    public $existingPhone = false;
    public $selectedPhone;

    protected $rules = [
        'selectedPhone.phone_number' => 'required|numeric|digits:10',
    ];

    public function mount() {
        $this->userPhones = PhoneNumber::where('user_id', '=', Auth::user()->id)->get();
    }

    public function editPhone($id = 0) {
        if($id > 0) $this->selectedPhone = $this->userPhones->find($id);
        $this->existingPhone = ($this->selectedPhone)? true : false;
    }

    public function updatePhone() {
        $this->validate();
        $this->selectedPhone->save();
        $this->userPhones = PhoneNumber::where('user_id', '=', Auth::user()->id)->get();
        $this->selectedPhone = null;
        $this->existingPhone = false;
    }

    public function createPhone() {
        $this->validate();
        PhoneNumber::create([
            'phone_number' => $this->selectedPhone['phone_number'],
            'user_id' => Auth::user()->id
        ]);
        $this->userPhones = PhoneNumber::where('user_id', '=', Auth::user()->id)->get();
        $this->existingPhone = false;
        $this->selectedPhone = null;
    }

    public function deletePhone($id = 0) {
        $deletedPhone = null;
        if($id > 0) $deletedPhone = $this->userPhones->find($id);
        if($deletedPhone) {
            $deletedPhone->delete();
            $this->selectedPhone = null;
            $this->existingPhone = false;
            $this->userPhones = PhoneNumber::where('user_id', '=', Auth::user()->id)->get();
        }
    }

    public function render() {
        return view('livewire.profile.phones');
    }
}
