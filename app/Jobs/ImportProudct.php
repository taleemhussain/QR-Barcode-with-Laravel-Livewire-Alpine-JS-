<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Batchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Warehouse;
use App\Models\JobBatches;

class ImportProudct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ,Batchable;
    public $header;
    public $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->header = "";
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $jobId = $this->job->getJobId();
        $batchId = $this->batchId;
        foreach($this->data as $file){

            $contents = Storage::disk('public')->get($file);
            $lines = explode("\n", $contents);
            // Remove empty rows
            $lines = array_filter($lines, 'strlen');
            // Convert the remaining lines to arrays
            $products = array_map('str_getcsv', $lines);
            //  if(1 == 1){
                foreach($products as $key => $product){
                    if($product[2] != 'price'){
                        $job_detail = JobBatches::where('id',$batchId)->first();
                        //create new and get existing brand id
                        $brand_name = $product[6];
                        $brand = Brand::firstOrCreate(['title' => $brand_name]);
                        
                        //create new and get existing category id
                        $category_name = $product[4];
                        $category = Categories::firstOrCreate(['title' => $category_name]);
                        
                        //create new  and get existing warehouse id
                        $warehouse_name = $product[5];
                        $warehouse_name = Warehouse::firstOrCreate(['title' => $warehouse_name]);
                        $row = array(
                            'title'=> $product[0],
                            'description'=> $product[1],
                            'price'=> 0,//$product[2],
                            'quantity'=> $product[3],
                            'category_id'=> $category->id,
                            'warehouse_id'=> $warehouse_name->id,
                            'brand_id'=> $brand->id,
                            'status'=> $product[7],
                        );
                        Product::create($row);
                        JobBatches::where('id',$batchId)->Update(['total_added'=> $job_detail->total_added+1]);

                        if (Storage::disk('public')->exists($file)) {
                            Storage::disk('public')->delete($file);
                        }
                    }
                }
            // }        
        }
        // foreach($this->data as $product){
            
        //     $row = array_combine($this->header,$product);
            
        //     //create new and get existing brand id
        //     $brand_name = $row['brand_id'];
        //     $brand = Brand::firstOrCreate(['title' => $brand_name]);
        //     $row['brand_id'] = $brand->id; 
            
        //     //create new and get existing category id
        //     $category_name = $row['category_id'];
        //     $category = Categories::firstOrCreate(['title' => $category_name]);
        //     $row['category_id'] = $category->id; 
            
        //     //create new  and get existing warehouse id
        //     $warehouse_name = $row['warehouse_id'];
        //     $warehouse_name = Warehouse::firstOrCreate(['title' => $warehouse_name]);
        //     $row['warehouse_id'] = $warehouse_name->id; 

        //     Product::create($row);
        // }
    }

    public function handle1()
    {
                    //$file = "/tmp1.csv";
            //$path = resource_path('temp/import');
            //$products = array_map('str_getcsv', file($path.$file));
            // $contents = Storage::disk('public')->get($file);
            // $products = array_map('str_getcsv', explode("\n", $contents));
        
        foreach($this->data as $product){
            
            $row = array_combine($this->header,$product);
            
            //create new and get existing brand id
            $brand_name = $row['brand_id'];
            $brand = Brand::firstOrCreate(['title' => $brand_name]);
            $row['brand_id'] = $brand->id; 
            
            //create new and get existing category id
            $category_name = $row['category_id'];
            $category = Categories::firstOrCreate(['title' => $category_name]);
            $row['category_id'] = $category->id; 
            
            //create new  and get existing warehouse id
            $warehouse_name = $row['warehouse_id'];
            $warehouse_name = Warehouse::firstOrCreate(['title' => $warehouse_name]);
            $row['warehouse_id'] = $warehouse_name->id; 

            Product::create($row);
        }
    }
    public function failed(Throwable $exception){
        
    }
}
