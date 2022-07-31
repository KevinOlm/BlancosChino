<?php

namespace App\Models;

class CartSession {

    public $items = null;
    public $total = 0;

    public function __construct($oldCart) {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->total = $oldCart->total;
        }
    }

    public function add($newItem, $quantity) {
        $storedItem = (object) ['id' => 0, 'quantity' => 0, 'subtotal' => 0, 'product' => $newItem];
        if ($this->items) if(array_key_exists($newItem->id, $this->items)) $storedItem = $this->items[$newItem->id];
        $this->total -= $storedItem->subtotal;

        if ($storedItem->quantity + $quantity > $newItem->stock) $storedItem->quantity = $newItem->stock;
        else $storedItem->quantity += $quantity;

        $storedItem->subtotal = $newItem->price * $storedItem->quantity;
        $storedItem->id = $newItem->id;
        $this->items[$newItem->id] = (object) $storedItem;
        $this->total += $storedItem->subtotal;
    }

    public function update($updatedItem, $quantity) {
        if($this->items) {
            if(array_key_exists($updatedItem->id, $this->items)) {
                $storedItem = $this->items[$updatedItem->id];
                if ($quantity > $updatedItem->stock) $storedItem->quantity = $updatedItem->stock;
                else $storedItem->quantity = $quantity;
                
                $storedItem->subtotal = $updatedItem->price * $storedItem->quantity;
                $this->items[$updatedItem->id] = (object) $storedItem;

                $newTotal = 0;
                foreach ($this->items as $item) $newTotal += $item->subtotal;
                $this->total = $newTotal;
            }
        }
    }

    public function delete($id) {
        if(array_key_exists($id, $this->items)) {
            $this->total -= $this->items[$id]->subtotal;
            unset($this->items[$id]);
        }
    }
}