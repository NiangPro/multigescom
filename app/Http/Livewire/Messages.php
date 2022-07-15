<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Messages extends Component
{
    public $current_user;

    public function changeEvent($user_id){
        $this->current_user = User::where('id', $user_id)->first();
        dd($this->current_user);
    }

    public function render()
    {
        return view('livewire.messages',[
            'users' => User::where('entreprise_id', Auth::user()->entreprise_id)->where('id', '!=' ,Auth::user()->id)->get(),
            ])->layout('layouts.app', [
            'title' => "Les Messages",
            "page" => "message",
            "icon" => "fa fa-envelope-open"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }
    }
}
