<?php

namespace App\Http\Livewire;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Brand;
use App\Models\JobBatches;
use Livewire\Component;
use Spatie\MediaLibrary\HasMedia;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportProudct;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Throwable;


class ProductList extends Component
{   
    use WithFileUploads;
    use WithPagination;

   public $product,$pending_job_batches,$batch_id;
   public $showConfirmationModal = false;
   public $deleteItemID,$file,$is_progress=false,$is_uploading=false;
   public $progress =0,$total_added=0,$total_records=0;
   protected $listeners = ['fileUpload' =>'handleFileUpload', 'getBatchProgress'=> 'updateBatchProgress','render'=> 'render','showProgressBar'=>'showProgressBar'];
    
    public function render($msg = null)
    {   
        if($msg == 'one_batch_completed'){
            $this->is_progress = false;
            session()->flash('one_batch_completed', 'Products have been successfully imported into the database.');
        }
        if($msg == 'all_batch_completed'){
            session()->flash('all_batch_completed', 'Products have been successfully imported into the database.');
        }
        $batch_list = JobBatches::where('pending_jobs','>',0)->where('failed_jobs','!=', 1)->get();
        $products = Product::paginate(7);
        return view('livewire.product-list', [
            'products' => $products,
            'batch_list'=> $batch_list,
        ])->layout('livewire.layouts.base');
    }
    public function handleFileUpload($file)
    {
       $this->file = $file;
       //$this->tmp_file = "";
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'file' => 'required'
        ]);
    }
    public function showConfirmation($id)
    {
        $this->deleteItemID = $id;
        $this->showConfirmationModal = true;
    }
    public function deleteUserData()
    {
        Product::find($this->deleteItemID)->delete();
        $this->showConfirmationModal = false;
        session()->flash('message', 'Member has been deleted successfully');
    }

    public function importProduct()
    {   
        $this->validate([
            'file' => 'required',
        ]);
        $header = [];
        //$path = resource_path('temp/import');
        $file = $this->file->getRealPath();
        $csv = file($file);
        $chunks = array_chunk($csv,1000);
        $batch = Bus::batch([])->dispatch();
        foreach ($chunks as $key => $chunk) {
            $currentDateTime = Carbon::now();
            $currentTimestamp = $currentDateTime->timestamp;
            $name = "tmp/tmp-{$currentTimestamp}-{$key}.csv";
            // Convert the $chunk array to a string
            $chunkString = implode("\n", $chunk);
            Storage::disk('public')->put($name, $chunkString); 
            //file_put_contents($path . $name, $chunk);
            $data = array(
                'file_name'=> $name
            );
            //ImportProudct::dispatch($data);
            $batch->add(new ImportProudct($data));
        }
        $this->is_progress = true;
        $this->file = "";
        $this->batch_id = $batch->id;
        session(['batch_id' => $this->batch_id]);
        JobBatches::where('id',$batch->id)->Update(['total_records'=> count($csv)-1]);
        $this->dispatchBrowserEvent('jsFunctionTriggered',['batch_id'=>$batch->id]);
        //$this->dispatchBrowserEvent('showProgressBar');
    }
    public function findBatch($batch_id = null){
        $batch_id = session('batch_id');
        $data = JobBatches::where('id',$batch_id)->first();
        //$progress = round(($data->total_added / $data->total_records) * 100);
        $progress = round(($data->total_added / $data->total_records) * 100);
        $data = array(
            'progress'=> $progress,
            'total_added'=> $data->total_added,
            'total_records'=> $data->total_records,
            'batch_id'=> $batch_id
        );
        return response()->json($data);
    }
    public function getPendingJobBatches(){
        $this->pending_job_batches = JobBatches::where('pending_jobs','>',0)->where('failed_jobs','!=', 1)->get();
        $data = array(
            'batches_list'=> $this->pending_job_batches,
            'pending'=> count($this->pending_job_batches)
        );
        return response()->json($data); 
    }

    // public function updateBatchProgress($batch_id){
    //     $data = JobBatches::where('id', $batch_id)->first();
    //     $progress = round(($data->total_added / $data->total_records) * 100);
    //     $this->progress = $progress;
    //     $this->total_added = $data->total_added;
    //     $this->total_records = $data->total_records;
    //     if($progress == 100){
    //         $this->dispatchBrowserEvent('jsFunctionTriggered2');
    //     }
    // }
























    public function showMsg(){
        $this->is_progress = true;
    }
    public function findBatch1($batch_id){
        $data =  Bus::findBatch($batch_id);
        $this->products = Product::get();
        return response()->json($data);
    }

    public function getBatchDetail($batch_id){
        $data =  Bus::findBatch($batch_id);
        return response()->json($data);
    }

    public function importProduct2()
    {  
        $path = resource_path('temp/import');     
        $csv = file($this->file);
        $chunks = array_chunk($csv,4);
        foreach ($chunks as $key => $chunk) {
            $name = "/tmp{$key}.csv";
            file_put_contents($path . $name, $chunk);
        }

        $files = glob("$path/*.csv");
        $header = [];
        foreach ($files as $key => $file) {
            $data = array_map('str_getcsv', file($file));
            if ($key == 0) {
                $header = $data[0];
                unset($data[0]);
            }
            ImportProudct::dispatch($data,$header);
            unlink($file);
        }

        session()->flash('message', 'Products adding please wait... ');
    }

    public function importProduct1()
    {    
        $csv = file($this->file);
        $chunks = array_chunk($csv,4);
        $header=[];
        $batch = Bus::batch([])->dispatch();
        foreach($chunks as $keys => $chunk){
            $data = array_map('str_getcsv',$chunk);    
            if($keys == 0){
                $header = $data[0];
                unset($data[0]);
            }
            $batch->add(new ImportProudct($data,$header));
        }
        //$batch->id
        session()->flash('message', 'Products adding please wait... ');
    }
    // $batch = Bus::batch([
        // ])->then(function (Batch $batch) {
        //     // All jobs completed successfully...
        //     Brand::firstOrCreate(['title' => 'Completed']); 
        // })->catch(function (Batch $batch, Throwable $e) {
        //     // First batch job failure detected...
        //     Brand::firstOrCreate(['title' => 'failure']);
        // })->finally(function (Batch $batch) {
        //     // The batch has finished executing...
        //     Brand::firstOrCreate(['title' => 'executing']);
        // })->dispatch();
}
