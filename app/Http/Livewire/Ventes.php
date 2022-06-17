<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ventes extends Component
{
    public function render()
    {
        return view('livewire.comptable.ventes')->layout('layouts.app', [
            'title' => "Les Ventes",
            "page" => "vente",
            "icon" => "fa fa-shopping-cart"
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
