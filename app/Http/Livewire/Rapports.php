<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Depense;
use App\Models\Vente;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Rapports extends Component
{
    public $depenses;
    public $ventes;
    public $astuce;
    
    public function render()
    {
        $this->astuce = new Astuce();
        $this->ventes = json_encode(Vente::get('montant')->pluck('montant'));
        // dd($this->astuce->getDepenses());
        
        return view('livewire.comptable.rapports',[
            'depenses' => $this->astuce->getDepenses(),
        ])->layout('layouts.app', [
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
