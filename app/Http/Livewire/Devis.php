<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Devis extends Component
{
    public function render()
    {
        return view('livewire.comptable.devis')->layout('layouts.app', [
            'title' => "Les Devis",
            "page" => "devis",
            "icon" => "fas fa-file-invoice"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

        if(Auth::user()->isCommercial()){
            return redirect(route("home"));
        }

    }
}
