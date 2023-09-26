<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;

class UserList extends Component
{   
   public $users;
   public $showConfirmationModal = false;
   public $userIdToDelete;

    public function render()
    {   
        $this->users = User::get();
        return view('livewire.user-list')->layout('livewire.layouts.base');
    }
    public function showConfirmation($userId)
    {
        $this->userIdToDelete = $userId;
        $this->showConfirmationModal = true;
    }

    // public function deleteUserData($id)
    // {
    //     $user = User::where('id',$id)->first();
    //     $user->delete();
    //     session()->flash('message', 'Member has been deleted successfully');
    // }
    public function deleteUserData($userId)
    {
       User::find($userId)->delete();
        $this->showConfirmationModal = false;
    }

    public function getItem()
    {
        $items = User::get();
        return view('livewire.user.item-list', ['items' => $items])->layout('livewire.layouts.base');

//        return view('livewire.user.item-list')->layout('livewire.layouts.base')->with('items',$items);
    }
}
