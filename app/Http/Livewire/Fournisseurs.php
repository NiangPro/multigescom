<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Fournisseurs extends Component
{
    public function render()
    {
        return view('livewire.fournisseurs')->layout('layouts.app', [
            'title' => "Fournisseurs",
            "page" => "fournisseur",
            "icon" => "fas fa-street-view"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
