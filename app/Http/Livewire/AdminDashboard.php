<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Warehouse;
use App\Models\User;
class AdminDashboard extends Component
{
    public $category_count,$brand_count,$warehouse_count,$product_count,$user_count;
    public $brands,$categories,$warehouses,$products,$users;
    public function render()
    {
        $this->users = User::count();
        $this->brands = Brand::count();
        $this->categories = Categories::count();
        $this->warehouses = Warehouse::count();
        $this->products = Product::count();
        return view('livewire.admin-dashboard')->layout('livewire.layouts.base');
    }
}
