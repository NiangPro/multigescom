<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Admins extends Component
{
    public function render()
    {
        return view('livewire.admin.admins')->layout('layouts.app', [
            'title' => "Administrateurs",
            "page" => "admin",
            "icon" => "fa fa-user-secret"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
