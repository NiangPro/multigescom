<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\StaticData;
use App\Models\Country;
use App\Models\Employe;

class Employes extends Component
{
    public $etat = "list";
    public $staticData;
    public $country;
    public $astuce;

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
        'form.prenom' => 'required|string',
        'form.nom' => 'required|string',
        'form.email' => 'required|string',
        'form.tel' => ['required', 'min:9', 'max:9', 'regex:/^[33|70|75|76|77|78]+[0-9]{7}$/'],
        'form.fonction' => 'required|string',
        'form.adresse' => 'required|string',
        'form.sexe' => 'required|string',
        'form.pays' => 'required|string',
    ];

    protected  $messages = [
        'form.prenom.required' => 'Le prenom est requis',
        'form.nom.required' => 'Le nom est requis',
        'form.email.required' => 'le mail est requis',
        'form.tel.required' => 'Le telephone est requis',
        'form.tel.regex' => 'Le n° de telephone est invalide',
        'form.tel.min' => 'Le n° de telephone doit avoir au minimum 9 chiffres',
        'form.tel.max' => 'Le n° de telephone doit avoir au maximum 9 chiffres',
        'form.fonction.required' => 'La fonction est requise',
        'form.adresse.required' => 'L\'adresse est requis',
        'form.sexe.required' => 'Le sexe est requis',
        'form.pays.required' => 'Le pays est requis'
    ];

    public function store(){

        $this->validate();

        Employe::create([
            'prenom' => $this->form['prenom'],
            'nom' => $this->form['nom'],
            'email' => $this->form['email'],
            'tel' => $this->form['tel'],
            'adresse' => $this->form['adresse'],
            'pays' => $this->form['pays'],
            'fonction' => $this->form['fonction'],
            'sexe' => $this->form['sexe'],
            'profil' => $this->form['sexe'] === 'Homme' ? 'user-male.png' : 'user-female.png',

        ]);

        $this->astuce->addHistorique("Ajout employé", "add");
        $this->dispatchBrowserEvent("addSuccessful");
        $this->changeEtat();

    }

    public function render()
    {
        $this->astuce = new Astuce();
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
