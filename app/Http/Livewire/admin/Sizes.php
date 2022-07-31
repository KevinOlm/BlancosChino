<?php

namespace App\Http\Livewire\Admin;

use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;

class Sizes extends Component
{
    use WithPagination;

    public $searchField = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $sortOptions = ['id', 'size', 'created_at'];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'createSizeConfirmation',
        'updateSizeConfirmation',
        'deleteSizeConfirmation',
    ];

    public function updatedSearchField() {
        $this->resetPage();
    }

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

    public function createSize() {
        $this->emit('createSize');
    }

    public function createSizeConfirmation($size) {
        if(strlen($size) > 0 && strlen($size) < 50) {
            Size::create([
                'size' => $size
            ]);
        }
    }

    public function updateSize($id = 0) {
        if($id > 1) $this->emit('updateSize', $id, Size::find($id)->size);
    }

    public function updateSizeConfirmation($id = 0, $size) {
        $editedSize = null;
        if($id > 1) $editedSize = Size::find($id);
        if($editedSize) {
            if(strlen($size) > 0 && strlen($size) < 50) {
                $editedSize->size = $size;
                $editedSize->save();
            }
        }
    }

    public function deleteSize($id = 0) {
        if($id > 1) $this->emit('deleteSize', $id);
    }

    public function deleteSizeConfirmation($id = 0) {
        $deletedSize = null;
        if($id > 1) $deletedSize = Size::find($id);
        if($deletedSize) {
            $deletedSize->delete();
        }
    }

    public function render() {
        $sizes = Size::
            where('id', '>', 1)
            ->where(function ($query) {
                $query
                ->where('id', 'like', '%' . $this->searchField . '%')
                ->orWhere('size', 'like', '%' . $this->searchField . '%')
                ->orWhere('created_at', 'like', '%' . $this->searchField . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(20);

        return view('livewire.admin.sizes', compact('sizes'));
    }
}
