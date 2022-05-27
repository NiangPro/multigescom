<?php

namespace App\Http\Livewire;



use App\Models\Astuce;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $astuce;
    public $todo = "list";
    public $dataSuperAdmin = [
        'nbreEntreprise',
        'nbreSuperAdmin',
        'nbreAdmin',
    ];

    public function formadd()
    {
        $this->todo = "add";
        dd("bien");
    }

    public function addTodo()
    {
        $this->todo = "list";
    }

    public function backTodo()
    {
        $this->todo = "list";
    }

    public function render()
    {

        $this->dataSuperAdmin['nbreEntreprise'] = count($this->astuce->entreprises());
        $this->dataSuperAdmin['nbreSuperAdmin'] = count($this->astuce->superAdmins());
        $this->dataSuperAdmin['nbreAdmin'] = count($this->astuce->admins());

        return view('livewire.home', [

        ])->layout('layouts.app', [
            'title' => "Tableau de bord",
            "page" => "home",
            "icon" => "fas fa-fire"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

        $this->astuce = new Astuce();
        if (Auth::user()->role === "Super Admin") {
            $this->astuce->initCountries();
        }
    }
}
