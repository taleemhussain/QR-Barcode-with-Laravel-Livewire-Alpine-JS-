<?php

namespace App\Http\Livewire\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Categories;
use Livewire\Component;

class UserItemList extends Component
{   
   public $items,$categories,$user_id;
   public $showConfirmationModal = false;
   public $userIdToDelete;

    public function mount($id){
        $this->user_id = $id;
    }
    public function render()
    {   
        $this->items = Order::join('products', 'orders.product_id', '=', 'products.id')
        ->join('category', 'products.category_id', '=', 'category.id')
        ->join('brand', 'products.brand_id', '=', 'brand.id')
        ->select(
            'orders.*',
            'products.*',
            'orders.quantity as order_qty',
            'category.title as category_name',
            'brand.title as brand_name'
        )
        ->when($this->user_id, function ($query) {
            $query->where('orders.user_id', $this->user_id);
        })->get();
        
        $this->categories = Categories::select('category.*')
        ->selectRaw('COUNT(orders.id) as order_count')
        ->selectRaw('SUM(orders.quantity) as total_quantity')
        ->join('products', 'category.id', '=', 'products.category_id')
        ->join('orders', 'products.id', '=', 'orders.product_id')
        ->groupBy('category.id')
        ->when($this->user_id, function ($query) {
            $query->where('orders.user_id', $this->user_id);
        })->get();
        return view('livewire.user.user-item-list')->layout('livewire.layouts.base');
    }
}
