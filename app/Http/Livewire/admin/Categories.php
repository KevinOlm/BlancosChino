<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $searchField = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $sortOptions = ['id', 'category', 'created_at'];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'updateCategoryConfirmation',
        'deleteCategoryConfirmation',
        'createCategoryConfirmation'
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

    public function createCategory() {
        $this->emit('createCategory');
    }

    public function createCategoryConfirmation($category) {
        if(strlen($category) > 0 && strlen($category) < 50) {
            Category::create([
                'category' => $category
            ]);
        }
    }

    public function updateCategory($id = 0) {
        if($id > 1) $this->emit('updateCategory', $id, Category::find($id)->category);
    }

    public function updateCategoryConfirmation($id = 0, $category) {
        $editedCategory = null;
        if($id > 1) $editedCategory = Category::find($id);
        if($editedCategory) {
            if(strlen($category) > 0 && strlen($category) < 50) {
                $editedCategory->category = $category;
                $editedCategory->save();
            }
        }
    }

    public function deleteCategory($id = 0) {
        if($id > 1) $this->emit('deleteCategory', $id);
    }

    public function deleteCategoryConfirmation($id = 0) {
        $deletedCategory = null;
        if($id > 1) $deletedCategory = Category::find($id);
        if($deletedCategory) {
            $deletedCategory->delete();
        }
    }

    public function render() {
        $categories = Category::
            where('id', '>', 1)
            ->where(function ($query) {
                $query
                ->where('id', 'like', '%' . $this->searchField . '%')
                ->orWhere('category', 'like', '%' . $this->searchField . '%')
                ->orWhere('created_at', 'like', '%' . $this->searchField . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(20);

        return view('livewire.admin.categories', compact('categories'));
    }
}
