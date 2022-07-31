<?php

namespace App\Http\Livewire\Profile;

use App\Models\PurchaseOrder;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ubication extends Component
{
    public $activePurchases = false;
    public $userAddresses;
    public $existingAddress = false;
    public $selectedAddress;
    public $states = [
        'Aguascalientes',
        'Baja California',
        'Baja California Sur',
        'Campeche',
        'Chiapas',
        'Chihuahua',
        'Ciudad de México',
        'Coahuila',
        'Colima',
        'Durango',
        'Estado de México',
        'Guanajuato',
        'Guerrero',
        'Hidalgo',
        'Jalisco',
        'Michoacán',
        'Morelos',
        'Nayarit',
        'Nuevo León',
        'Oaxaca',
        'Puebla',
        'Querétaro',
        'Quintana Roo',
        'San Luis Potosí',
        'Sinaloa',
        'Sonora',
        'Tabasco',
        'Tamaulipas',
        'Tlaxcala',
        'Veracruz',
        'Yucatán',
        'Zacatecas',
    ];

    protected $rules = [
        'selectedAddress.state' => 'required|in_array:states.*',
        'selectedAddress.city' => 'required|string|max:255|min:1',
        'selectedAddress.street' => 'required|string|max:255|min:1',
        'selectedAddress.postal_code' => 'required|numeric|digits:5',
    ];

    public function mount() {
        $this->userAddresses = UserAddress::where('user_id', '=', Auth::user()->id)->get();
        $userPurchaseOrders = PurchaseOrder::where('user_id', '=', Auth::user()->id)->get();
        foreach($userPurchaseOrders as $userPurchaseOrder) {
            if($userPurchaseOrder->status === 'Procesando pago' || $userPurchaseOrder->status === 'Enviando') {
                $this->activePurchases = true;
                break;
            }
        }
    }

    public function createAddress() {
        $this->validate();
        $firstAddress = (count($this->userAddresses) === 0)? true : false;
        UserAddress::create([
            'state' => $this->selectedAddress['state'],
            'city' => $this->selectedAddress['city'],
            'street' => $this->selectedAddress['street'],
            'postal_code' => $this->selectedAddress['postal_code'],
            'selected' => $firstAddress,
            'user_id' => Auth::user()->id,
        ]);
        $this->userAddresses = UserAddress::where('user_id', '=', Auth::user()->id)->get();
        $this->selectedAddress = null;
        $this->existingAddress = false;
    }

    public function editAddress($id = 0) {
        $editedAddress = null;
        if($id > 0) $editedAddress = $this->userAddresses->find($id);
        if($editedAddress && !$editedAddress->selected) {
            $this->selectedAddress = $editedAddress;
            $this->existingAddress = true;
        }
    }

    public function changeSelectedAddress($id = 0) {
        $newSelectedAddress = null;
        if($id > 0) $newSelectedAddress = $this->userAddresses->find($id);
        if($newSelectedAddress && !$this->activePurchases) {
            foreach($this->userAddresses as $userAddress) {
                if($id === $userAddress->id) $userAddress->selected = true;
                else $userAddress->selected = false;
                $userAddress->save();
            }
        }
    }
    
    public function deleteAddress($id = 0) {
        $deletedAddress = null;
        if($id > 0) $deletedAddress = $this->userAddresses->find($id);
        if($deletedAddress && !$deletedAddress->selected) {
            $deletedAddress->delete();
            $this->selectedAddress = null;
            $this->existingAddress = false;
            $this->userAddresses = UserAddress::where('user_id', '=', Auth::user()->id)->get();
        }
    }

    public function updateAddress() {
        $this->validate();
        $this->selectedAddress->save();
        $this->userAddresses = UserAddress::where('user_id', '=', Auth::user()->id)->get();
        $this->selectedAddress = null;
        $this->existingAddress = false;
    }

    public function render(){
        return view('livewire.profile.ubication');
    }
}
