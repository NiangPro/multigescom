<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Employe;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Taches extends Component
{

    public $status="listTaches";
    public $astuce;
    public $staticData;
    public $current_tache;
    public $idDeleting;
    protected $listeners = ['remove'];

    public function changeEtat($etat){
        $this->status = $etat;
    }

    public function render()
    {
        $this->astuce = new Astuce();
        $this->staticData = $this->astuce->getStaticData("Priorité des tâches");

        return view('livewire.admin.taches',[
            "employes" => Employe::orderBy('id', 'DESC')->get(),
        ])->layout('layouts.app', [
            'title' => "Taches",
            "page" => "tache",
            "icon" => "fas fa-edit"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

    }
}
