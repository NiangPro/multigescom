<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comptable extends Component
{
    public function render()
    {
        return view('livewire.admin.comptable')->layout('layouts.app', [
            'title' => "Comptables",
            "page" => "comptable",
            "icon" => "fa fa-user-secret"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
