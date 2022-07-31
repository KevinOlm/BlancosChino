<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductComments extends Component
{
    public $productGeneral;
    public $previousReview;
    public $rate = 1;
    public $comment;

    protected $listeners = ['render'];

    public function mount(Product $productGeneral) {
        $this->productGeneral = $productGeneral;
        if(Auth::check()) {
            $review = Review::where([
                ['user_id', '=', Auth::user()->id],
                ['product_id', '=', $this->productGeneral->id],
            ])->first();
            if($review) {
                $this->previousReview = $review;
                $this->rate = intval($this->previousReview->review);
                $this->comment = $this->previousReview->comment;
            }
            else {
                $this->previousReview = null;
                $this->rate = 1;
                $this->comment = "";
            }
        }
    }

    public function createReview() {
        if(Auth::check() && $this->previousReview === null) {
            $this->previousReview = Review::create([
                'review' => $this->rate,
                'comment' => $this->comment,
                'user_id' => Auth::user()->id,
                'product_id' => $this->productGeneral->id,
            ]);
            $this->emit('render');
        }
    }

    public function updateReview() {
        if($this->previousReview) {
            $this->previousReview->review = $this->rate;
            $this->previousReview->comment = $this->comment;
            $this->previousReview->save();
            $this->emit('render');
        }
    }

    public function deleteReview() {
        if($this->previousReview) {
            $this->previousReview->delete();
            $this->previousReview = null;
            $this->rate = 1;
            $this->comment = "";
            $this->emit('render');
        }
    }

    public function render() {
        return view('livewire.product-comments');
    }
}
