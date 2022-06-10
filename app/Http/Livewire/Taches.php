<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Taches extends Component
{
    public function render()
    {
        return view('livewire.admin.taches')->layout('layouts.app', [
            'title' => "Taches",
            "page" => "tache",
            "icon" => "fas fa-edit"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
