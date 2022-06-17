<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rapports extends Component
{
    public function render()
    {
        return view('livewire.comptable.rapports')->layout('layouts.app', [
            'title' => "Les Rapports",
            "page" => "rapport",
            "icon" => "fas fa-chart-bar"
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
