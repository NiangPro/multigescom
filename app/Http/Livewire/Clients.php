<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Clients extends Component
{
    public $status="listClients";

    public function changeEtat($etat){
        $this->status = $etat;
    }

    public function render()
    {
        return view('livewire.commercial.clients')->layout('layouts.app', [
            'title' => "Clients",
            "page" => "client",
            "icon" => "fa fa-users"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
