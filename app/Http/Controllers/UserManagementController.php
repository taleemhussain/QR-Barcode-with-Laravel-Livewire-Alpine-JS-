<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Carbon;

class UserManagementController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function findBatch($batch_id){
        $data =  Bus::findBatch($batch_id);
        return response()->json($data);
        // $data = DB::table('job_batches')->where('pending_jobs', '>', 0)->first();
        // if($data){
        //     $completed = $data->total_jobs - $data->pending_jobs;
        //     $progress = round(($completed / $data->total_jobs) * 100);
        //     $this->progress = 10;
        //     $data = array(
        //         'progress'=> $progress
        //     );
        //     return response()->json($data);
        // }
    }

    public function progress($id)
    {   
        $percentage = $id+5;
        $batchId = "9a1444bc-19e1-4895-907e-4bc292954370";
        $data =  Bus::findBatch($batchId);
        $array = array(
            'progress'=> $percentage
        );
        return json_encode($array);
    }

    // public function findBatch($batch_id)
    // {   
    //     $data =  Bus::findBatch($batch_id);
    //     return response()->json($data);
    // }

    public function test()
    {

        $currentDateTime = Carbon::now();
        echo $currentDateTime;
        die();
        $file = 'tmp/tmp0.csv';

        $contents = Storage::disk('public')->get($file);
            $lines = explode("\n", $contents);
            // Remove empty rows
            $lines = array_filter($lines, 'strlen');
            $products = array_map('str_getcsv', $lines);
            echo '<pre>';
            print_r($products);
            die();
if (Storage::disk('public')->exists($fileToDelete)) {
    Storage::disk('public')->delete($fileToDelete);
    return "File deleted successfully!";
}

        die();
        $batch_id = "9a161d77-4e49-482b-9bc6-8490d4351941";
        //$data = Bus::findBatch($batch_id);
        $data = DB::table('job_batches')->where('id',$batch_id)->first();
        echo '<pre>';
        print_r($data->total_jobs);
        die();
        $completed = 51;
        $total = 51;
        $progress = round(($completed / $total) * 100);
        return $progress;
        
        $batchId = "9a1444bc-19e1-4895-907e-4bc292954370";
        $data =  Bus::findBatch($batchId);
        // echo '<pre>';
        // print_r($data->json());
        // die();
        return $data; //->progress;
        //return $totalJobs;

        // phpinfo();

        die();
        // Generate the barcode using the product's data.
        $barcode = QrCode::format('png')->size(200)->generate(123412);

        // You can return the barcode image directly or display it in a view.
        // For demonstration, we will return it as an image response.
        return response($barcode)->header('Content-Type', 'image/png');
    }
    public function test_1(){

        $file = "/tmp1.csv";
        $path = resource_path('temp/import');

        
        $productId = 1430;
        $product = Product::find($productId);
        $data = [
            'Title' => $product->title,
            'Brand' => $product->brand_id,
            'Price' => $product->price,
        ];
        $qrCode = QrCode::size(250)->generate(json_encode($data));
        return view('qr_code', compact('qrCode')); 
    }

    public function test1(){

        $data1[]= array(
            'file_name'=> 12,
            'header'=> 0
        );

        $path = resource_path('temp/import');    
        $files = glob("$path/*.csv");
        foreach ($files as $key => $file) {
            if ($key == 0) {
                $data = array_map('str_getcsv', file($path.'/tmp0.csv'));
                echo '<pre>';
                print_r($data1);
            }
        }
    }
}
