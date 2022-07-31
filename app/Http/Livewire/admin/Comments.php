<?php

namespace App\Http\Livewire\Admin;

use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $searchField = '';
    public $sort = 'reviews.id';
    public $direction = 'desc';
    public $sortOptions = [
        'reviews.id',
        'users.name',
        'products.groupName',
        'reviews.review',
        'reviews.comment',
        'reviews.created_at',
    ];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['editCommentConfirmation', 'eliminateCommentConfrimation'];

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

    public function updatedSearchField() {
        $this->resetPage();
    }

    public function editComment($id = 0) {
        if($id > 0) $this->emit('editComment', $id, Review::find($id)->comment);
    }

    public function editCommentConfirmation($id, $comment) {
        if($id > 0) {
            $editedComment = Review::find($id);
            $editedComment->comment = $comment;
            $editedComment->save();
        }
    }

    public function eliminateComment($id = 0) {
        if($id > 0) $this->emit('eliminateComment', $id);
    }

    public function eliminateCommentConfrimation($id) {
        if($id > 0) {
            $deletedComment = Review::find($id);
            $deletedComment->delete();
        }
    }

    public function render() {
        $comments = DB::table('reviews')
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->select('reviews.*', 'users.name', 'products.groupName')
            ->where('reviews.id', 'like', '%' . $this->searchField . '%')
            ->orWhere('users.name', 'like', '%' . $this->searchField . '%')
            ->orWhere('products.groupName', 'like', '%' . $this->searchField . '%')
            ->orWhere('reviews.review', 'like', '%' . $this->searchField . '%')
            ->orWhere('reviews.comment', 'like', '%' . $this->searchField . '%')
            ->orWhere('reviews.created_at', 'like', '%' . $this->searchField . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(20);

        return view('livewire.admin.comments', compact('comments'));
    }
}
