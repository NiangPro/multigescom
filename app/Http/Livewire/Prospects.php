<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Prospects extends Component
{
    protected $listeners = ['remove'];
    public $status = "listProspects";

    public function changeEtat($etat){
        $this->status = $etat;
    }

    public function render()
    {
        return view('livewire.commercial.prospects',[
            "country" => Country::orderBy('nom_fr', 'ASC')->get(),

        ])->layout('layouts.app', [
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
