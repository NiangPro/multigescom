<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Prospects extends Component
{
    public function render()
    {
        return view('livewire.commercial.prospects')->layout('layouts.app', [
            'title' => "Prospects",
            "page" => "prospect",
            "icon" => "fa fa-tty"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
