<?php
namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Warehouse;
class AddProduct extends Component
{   
    public $title,$price,$category,$status,$description,$quantity,$category_id,$sku,$brand_id,$warehouse_id,$image;
    public $brands,$Categories,$warehouses,$products;
    protected $listeners = ['fileUpload' =>'handleFileUpload', 'scanQRCode'=> 'addQRProduct'];
    
    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }
    public function addQRProduct($content,$type = null)
    { 
        $this->description = $content;
        if($type == 'barcode'){
            $product_data = Product::where('id',$content)->first();
        }else{
            $product_data = json_decode($content, true);
        }
        $this->title = $product_data['title'];
        $this->price = $product_data['price'];
        $this->sku = $product_data['sku'];
        $this->quantity = $product_data['quantity'];
        $this->brand_id = $product_data['brand_id'];
        $this->warehouse_id = $product_data['warehouse_id'];
        //$this->description = $product_data['description'];
        $this->category_id = $product_data['category_id'];
        $this->status = $product_data['status'];
        
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

    public function render()
    {
        $this->brands = Brand::where('status',1)->get();
        $this->categories = Categories::where('status',1)->get();
        $this->warehouses = Warehouse::where('status',1)->get();
        return view('livewire.add-product')->layout('livewire.layouts.base');
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
    public function addProduct(){
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
            'sku'=> $this->sku,
            'image'=>$this->storeImage()
        );
        $data = Product::create($data);
        if($data){
            $this->resetFields();
            session()->flash('message','Product has been added successfully');
        }else{
            session()->flash('message','Something went wrong please try again!');
        }
    }
    public function getProductDetails($productId)
    {
        $brand = Brand::firstOrCreate(['title' => '1212']);
        //$this->description = $productId;
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
