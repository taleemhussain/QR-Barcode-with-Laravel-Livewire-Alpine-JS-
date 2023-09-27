<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Categories;
class Dashboard extends Component
{
    public $items,$categories,$user_id;
   public $showConfirmationModal = false;
   public $userIdToDelete;

    public function mount(){
        $this->user_id = auth()->id();
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
        
        $this->categories = Categories::select('category.id', 'category.title') 
        ->selectRaw('COUNT(orders.id) as order_count')
        ->selectRaw('SUM(orders.quantity) as total_quantity')
        ->join('products', 'category.id', '=', 'products.category_id')
        ->join('orders', 'products.id', '=', 'orders.product_id')
        ->groupBy('category.id', 'category.title') 
        ->when($this->user_id, function ($query) {
            $query->where('orders.user_id', $this->user_id);
        })
        ->get();
    
        return view('livewire.dashboard')->layout('livewire.layouts.base');
    }
}
