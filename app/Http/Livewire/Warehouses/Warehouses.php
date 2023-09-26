<?php

namespace App\Http\Livewire\Warehouses;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\Warehouse;
class Warehouses extends Component
{   
    public $title,$image,$status,$warehouses,$itemID,$showConfirmationModal,$showEditModal,$editTitle,$editStatus;
    
    public function render()
    {
        $this->warehouses = Warehouse::get();
        return view('livewire.warehouses.list')->layout('livewire.layouts.base');
    }

    public function resetFields(){
        $this->title = '';
        $this->image = '';
        $this->status = '';
    }
    
    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'status' => 'required',
        ]);
    }
    
    public function add(){
        //on form submit validation
        $this->validate([
            'title' => 'required|unique:warehouse',
            'status' => 'required',
        ]);
        $data = array(
            'title' => $this->title,
            'status' => $this->status,
        );
        $data = Warehouse::create($data);

        if($data){
            $this->resetFields();
            $this->showEditModal = false;
            session()->flash('message','Warehouse has been added successfully');
        }else{
            session()->flash('message','Something went wrong please try again!');
        }
    }

    public function edit(){
        //on form submit validation
        $this->validate([
            'editTitle' => 'required|unique:warehouse,title,'.$this->itemID.'',
            'editStatus' => 'required',
        ]);
        $data = array(
            'title' => $this->editTitle,
            'status' => $this->editStatus,
        );
        
        $data = Warehouse::where('id',$this->itemID)->Update($data);

        if($data){
            session()->flash('message','Warehouse has been updated successfully');
        }else{
            session()->flash('message','Something went wrong please try again!');
        }
    }
    public function showConfirmation($id)
    {
        $this->itemID = $id;
        $this->showConfirmationModal = true;
    }
    public function deleteUserData()
    {
        Warehouse::find($this->itemID)->delete();
        $this->showConfirmationModal = false;
        //session()->flash('message', 'warehouse has been deleted successfully');
    }
    public function editCategory($id){
        $this->itemID = $id;
        $data = Warehouse::where('id',$this->itemID)->first();
        $this->editTitle = $data->title;
        $this->editStatus = $data->status;
        $this->showEditModal = true;
    }
    public function closeModel(){
        $this->showEditModal = false;
    }
}
