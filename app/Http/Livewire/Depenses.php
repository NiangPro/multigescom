<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Depenses extends Component
{
    public function render()
    {
        return view('livewire.depenses')->layout('layouts.app', [
            'title' => "Les Dépenses",
            "page" => "depense",
            "icon" => "fas fa-balance-scale"
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
