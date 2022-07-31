<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $sort = "id";
    public $direction = "desc";
    public $sortOptions = ["id", "name", "email", "created_at", "user_type"];
    public $search = '';

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'makeAdminConfirmation',
        'blockCommentsConfirmation',
        'deleteUserConfirmation',
    ];

    public function sort($order) {
        if($this->sort === $order) {
            if($this->direction === 'asc') $this->direction = 'desc';
            else $this->direction = 'asc';
        }
        else if (in_array($order, $this->sortOptions)) {
            $this->sort = $order;
            $this->direction = 'asc';
        }
    }

    public function makeAdmin($id = 0) {
        if($id > 0) $this->emit('makeAdmin', $id);
    }
    
    public function makeAdminConfirmation($id = 0) {
        if($id > 0) {
            $adminUser = User::find($id);
            if($adminUser) {
                $adminUser->user_type = 'admin';
                $adminUser->save();
            }
        }
    }

    public function removeAdmin($id = 0) {
        if($id > 0) {
            $adminUser = User::find($id);
            if($adminUser) {
                $adminUser->user_type = 'user';
                $adminUser->save();
            }
        }
    }
    
    public function blockComments($id = 0) {
        if($id > 0) $this->emit('blockComments', $id);
    }
    
    public function blockCommentsConfirmation($id = 0) {
        if($id > 0) {
            $blockedUser = User::find($id);
            if($blockedUser) {
                $blockedUser->user_type = 'user.noComment';
                $blockedUser->save();
            }
        }
    }

    public function removeBlockComments ($id = 0) {
        if($id > 0) {
            $adminUser = User::find($id);
            if($adminUser) {
                $adminUser->user_type = 'user';
                $adminUser->save();
            }
        }
    }

    public function showAddress($id = 0) {
        $user = null;
        if($id > 0) $user = User::find($id);
        if($user) {
            if(count($user->userAddresses) > 0) {
                $this->emit(
                    'showAddress',
                    $user->userAddresses->where('selected', true)->first(),
                    $user->phoneNumbers
                );
            }
            else $this->emit('noAddress');
        }
    }

    public function deleteUser($id = 0) {
        if($id > 0) $this->emit('deleteUser', $id);
    }

    public function deleteUserConfirmation($id = 0) {
        if($id > 0) {
            $deletedUser = User::find($id);
            if($deletedUser) {
                $deletedUser->delete();
            }
        }
    }

    public function render() {
        $users = User::where('id', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('created_at', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(20);

        return view('livewire.admin.users', compact('users'));
    }
}
