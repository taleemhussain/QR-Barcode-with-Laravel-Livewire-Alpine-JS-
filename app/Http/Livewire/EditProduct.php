<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
class EditProduct extends Component
{   
    public $title,$price,$category,$status,$description,$quantity,$products,$productID,$image;  
    public $brands,$Categories,$warehouses;
    protected $listeners = ['fileUpload' =>'handleFileUpload'];
    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }
    public function mount($id)
    {   
        $this->brands = Brand::where('status',1)->get();
        $this->categories = Categories::where('status',1)->get();
        $this->warehouses = Warehouse::where('status',1)->get();
        $product = Product::where('id',$id)->first();
        $this->productID = $product->id;
        $this->title = $product->title;
        $this->price = $product->price;
        $this->category = 0;
        $this->status = $product->status;
        $this->description = $product->description;
        $this->quantity = $product->quantity;  
        $this->sku = $product->sku;  
        $this->category_id = $product->category_id;  
        $this->brand_id = $product->brand_id;
        $this->warehouse_id = $product->warehouse_id;  
        $this->image = $product->image;  
    }
    
    public function render()
    {   
        return view('livewire.edit-product')->layout('livewire.layouts.base');
    }
    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'warehouse_id' => 'required',
            'sku' => 'required',
        ]);
    }
    public function resetFields(){
        $this->title = '';
        $this->price = '';
        $this->category = '';
        $this->status = '';
        $this->quantity='';
        $this->description = '';
        $this->category_id = '';
        $this->brand_id = '';
        $this->warehouse_id = '';
        $this->sku = '';
    }
    public function edit(){
        //on form submit validation
        $this->validate([
            'title' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'warehouse_id' => 'required',
            'sku' => 'required',
        ]);
        $data = array(
            'title' => $this->title,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'description'=> $this->description,
            'category_id'=> $this->category_id,
            'brand_id'=> $this->brand_id,
            'warehouse_id'=> $this->warehouse_id,
            'sku'=> $this->sku
        );
        $image = $this->storeImage();
        if($image){
            $data['image'] = $image;
        }

        $data = Product::where('id',$this->productID)->Update($data);
        if($data){
            session()->flash('message','Product has been updated successfully');
        }else{
            session()->flash('message','Something went wrong please try again!');
        }
    }
    public function storeImage()
    {
        if (!$this->image) {
            return '';
        }
        $img   = ImageManagerStatic::make($this->image)->encode('jpg');
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }
}
