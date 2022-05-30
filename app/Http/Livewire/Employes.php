<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\StaticData;
use App\Models\Country;

class Employes extends Component
{
    public $etat = "list";
    public $staticData;
    public $country;

    public function changeEtat(){
        if($this->etat === 'list'){
            $this->etat = "add";
        }else {
            $this->etat = "list";
        }
    }

    public $form = [
        'prenom' => '',
        'nom' => '',
        'email' => '',
        'tel' => '',
        'fonction' => '',
        'adresse' => '',
        'sexe' => '',
        'pays' => '',
    ];

    public $rules = [
        'form.prenom' => 'require|string',
        'form.nom' => 'require|string',
        'form.email' => 'require|string',
        'form.tel' => 'require|string',
        'form.fonction' => 'require|string',
        'form.adresse' => 'require|string',
        'form.sexe' => 'require|string',
        'form.pays' => 'require|string',
    ];

    protected  $alerte = [
        'form.prenom.required' => 'Le prenom est requis',
        'form.nom.required' => 'Le prenom est requis',
        'form.email.required' => 'Le prenom est requis',
        'form.tel.required' => 'Le prenom est requis',
        'form.fonction.required' => 'Le prenom est requis',
        'form.adresse.required' => 'Le prenom est requis',
        'form.sexe.required' => 'Le prenom est requis',
        'form.pays.required' => 'Le prenom est requis'
    ];

    public function store(){

    }

    public function render()
    {
        $this->staticData = StaticData::where("type", "Type de fonction")->where("entreprise_id", Auth::user()->entreprise_id)->get();
        $this->country = Country::orderBy('nom_fr', 'ASC')->get();
        return view('livewire.admin.employes', [

            ])->layout('layouts.app', [
                'title' => "Employés",
                "page" => "employe",
                "icon" => "fas fa-user-friends"
            ]);
        }

        public function mount(){
            if(!Auth::user()){
                return redirect(route('login'));
            }
        }
}
