<?php

namespace App\Http\Livewire\Item;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\user;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Warehouse;
use App\Models\Order;
class Item extends Component
{   
   public $category_id,$brand_id,$title,$user_id,$quantiy;
   public $brands,$categories,$warehouses,$products,$users;
   public $selected_items,$cart;
   protected $listeners = ['updateCartItem']; 
   public function mount()
    {   

    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'user_id' => 'required'
        ]);
    }
    public function render()
    {   

        //get product detail
        $this->products = Product::when($this->category_id, function ($query) {
            $query->where('category_id', $this->category_id);
        })->when($this->brand_id, function ($query) {
            $query->where('brand_id', $this->brand_id);
        })->when($this->title, function ($query) {
            $query->where('title', 'like', '%' . $this->title . '%');
        })->get();        
        $this->users = User::get();
        $this->brands = Brand::where('status',1)->get();
        $this->categories = Categories::where('status',1)->get();
        $this->warehouses = Warehouse::where('status',1)->get();

        $this->cart = Session::get('cart', []);
        $this->selected_items = Product::whereIn('id',$this->getCartItemIds($this->cart))->get();
        return view('livewire.item.list')->layout('livewire.layouts.base');
    }
    public function assignItem(){
        $this->validate([
            'user_id' => 'required'
        ]);
        $carts = $this->cart;
        foreach ($carts as $cart){
            $data = array(
                'product_id' => $cart['items']['product_id'],
                'user_id' => $this->user_id,
                'quantity'=> $cart['items']['quantity'],
            );
            $data = Order::create($data);
            $update_product = Product::find($cart['items']['product_id']);
            $new_quantity = $update_product->quantity - $cart['items']['quantity'];
            $update_product->quantity = $new_quantity;
            $update_product->save();
        }
        if(isset($data)){
            $this->clearCart();
            $this->user_id="";
            session()->flash('message','Products submited successfully.');
        }else{
            session()->flash('error','Please select atleast one product');
        }
    }
    public function addToCart($id,$quantity)
    {   
        $cart = Session::get('cart', []);
        $product = $this->getProductDetail('id',$id);
        if (isset($cart[$id])) {
            $quantity1 = $cart[$id]['items']['quantity'] + $quantity;
            if($product->quantity >= $quantity1){
                $cart[$id]['items']['quantity'] += $quantity;
                Session::put('cart', $cart);
            }
        } else {
            if($product->quantity >= $quantity){
                $cart[$id]['items']['product_id'] = $id;
                $cart[$id]['items']['quantity'] = $quantity;
                Session::put('cart', $cart);
            }
        }
    }

    public function getCartItemIds($cart){
        $ids = [];
        foreach ($cart as $item) {
            $ids[] = $item['items']['product_id'];
        }
        return $ids;
    }
    public function updateCartItem($id,$quantity)
    {   
        $product = $this->getProductDetail('id',$id);
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            if($product->quantity >= $quantity and $quantity > 0){
                $cart[$id]['items']['quantity'] = $quantity;
                Session::put('cart', $cart);
            }
        }
    }   
    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
    }    
    public function clearCart(){
        Session::forget('cart');
    }
    public function getProductDetail($column,$value){
        $product = Product::where($column,$value)->first();
        return $product;
    }
}