<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
class EditUser extends Component
{   
    public $user_detail,$name,$email,$password;
    
    public $userId;

    public function mount($id)
    {
        $this->userId = $id;
        
    }
    public function render()
    {   $user = User::where('id',$this->userId)->first();
        if (!$this->name) {
            $this->name = $user->name;
        }
        if (!$this->email) {
            $this->email = $user->email;
        }
        return view('livewire.edit-user')->layout('livewire.layouts.base');
    }
    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->userId.'',
        ]);
    }
    public function updateMember(){
        //on form submit validation
        $this->validate([
            'email' => 'required|unique:users,email,'.$this->userId.'',
            'name' => 'required',
        ]);
        $data = array(
            'name' => $this->name,
            'email' => $this->email
        );
        if($this->password !=''){
            $data['password'] = Hash::make($this->password);
        }
        $data = User::where('id',$this->userId)->Update($data);
        if($data){
            session()->flash('message','User has been updated successfully');
        }else{
            session()->flash('message','Something went wrong please try again!');
        }
    }
}
