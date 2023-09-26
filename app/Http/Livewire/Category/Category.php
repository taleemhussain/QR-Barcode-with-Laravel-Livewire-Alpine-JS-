<?php

namespace App\Http\Livewire\Category;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\Categories;
class Category extends Component
{   
    public $title,$image,$status,$categories,$itemID,$showConfirmationModal,$showEditModal,$editTitle,$editStatus;
    
    public function render()
    {
        $this->categories = Categories::get();
        return view('livewire.category.list')->layout('livewire.layouts.base');
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
            'title' => 'required|unique:category',
            'status' => 'required',
        ]);
        $data = array(
            'title' => $this->title,
            'status' => $this->status,
        );
        $data = Categories::create($data);

        if($data){
            $this->resetFields();
            $this->showEditModal = false;
            session()->flash('message','Category has been added successfully');
        }else{
            session()->flash('message','Something went wrong please try again!');
        }
    }

    public function edit(){
        //on form submit validation
        $this->validate([
            'editTitle' => 'required|unique:category,title,'.$this->itemID.'',
            'editStatus' => 'required',
        ]);
        $data = array(
            'title' => $this->editTitle,
            'status' => $this->editStatus,
        );
        
        $data = Categories::where('id',$this->itemID)->Update($data);

        if($data){
            session()->flash('message','Category has been updated successfully');
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
        Categories::find($this->itemID)->delete();
        $this->showConfirmationModal = false;
        //session()->flash('message', 'Category has been deleted successfully');
    }
    public function editCategory($id){
        $this->itemID = $id;
        $data = Categories::where('id',$this->itemID)->first();
        $this->editTitle = $data->title;
        $this->editStatus = $data->status;
        $this->showEditModal = true;
    }
    public function closeEditCategory(){
        $this->showEditModal = false;
    }
}
