<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reunions extends Component
{
    protected $listeners = ['remove'];
    public $status = "listReunions";

    public function changeEtat($etat){
        $this->status = $etat;
    }

    public function render()
    {
        return view('livewire.commercial.reunions')->layout('layouts.app', [
            'title' => "Réunions",
            "page" => "reunion",
            "icon" => "fa fa-handshake"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
