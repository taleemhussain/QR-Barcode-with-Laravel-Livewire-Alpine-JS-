<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
class AddUser extends Component
{   
    public $name,$email,$password;
    
    
    public function render()
    {
        return view('livewire.add-user')->layout('livewire.layouts.base');
    }

    public function resetFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }
    
    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
    public function addMember(){
        //on form submit validation
        $this->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
        ]);
        $data = array(
            'name' => $this->name,
            'email' => $this->email,
            'password'=> Hash::make($this->password),
        );
        $data = User::create($data);
        if($data){
            $this->resetFields();
            session()->flash('message','User has been added successfully');
        }else{
            session()->flash('message','Something went wrong please try again!');
        }
    }
}
