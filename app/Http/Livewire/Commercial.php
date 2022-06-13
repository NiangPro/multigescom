<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Commercial extends Component
{
    public function render()
    {
        return view('livewire.admin.commercial')->layout('layouts.app', [
            'title' => "Commerciaux",
            "page" => "commercial",
            "icon" => "fa fa-user-circle"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
