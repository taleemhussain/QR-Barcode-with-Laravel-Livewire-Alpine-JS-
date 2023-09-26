<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
class UploadFile extends Component
{   
    use WithFileUploads;

    public $file;
    public $progress = 100;

    public function render()
    {
        if($this->file !=''){
            for ($i = 0; $i < 20000; $i++) {
                // Your code to be executed in the loop goes here
                //$path = $this->file->store('uploads', 'public');
            }
        }
        return view('livewire.upload-file')->layout('livewire.layouts.base');
    }

    public function upload()
    {
        $this->validate([
            'file' => 'required', // Adjust max size as needed
        ]);
        $this->progress = 0;

        $path = $this->file->store('uploads', 'public');
        $this->progress = 100;
        // Process the uploaded file here (e.g., import CSV data, etc.)

        //$this->reset(['file', 'progress']);
        session()->flash('success', 'File uploaded successfully!');
    }

}
