<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Clients extends Component
{
    public $status="listClients";

    public $form = [
        'nom' => '',
        'adresse' => '',
        'tel' => '',
        'email' => '',
        'pays' => null,
    ];

    protected $rules = [
        'form.nom' => 'required|string',
        'form.adresse' => 'required|string',
        'form.tel' => ['required', 'min:9', 'max:9', 'regex:/^[33|70|75|76|77|78]+[0-9]{7}$/'],
        'form.email' => 'required|string',
        'form.pays' => 'required',
    ];

    protected  $messages = [
        'form.nom.required' => 'Le nom est requis',
        'form.adresse.required' => 'L\'adresse est requis',
        'form.tel.required' => 'Le telephone est requis',
        'form.tel.regex' => 'Le n° de telephone est invalide',
        'form.tel.min' => 'Le n° de telephone doit avoir au minimum 9 chiffres',
        'form.tel.max' => 'Le n° de telephone doit avoir au maximum 9 chiffres',
        'form.email.required' => 'le mail est requis',
        'form.pays.required' => 'Le pays est requis',
    ];

    public function initForm(){
        $this->form['nom']='';
        $this->form['adresse']='';
        $this->form['tel']='';
        $this->form['email']='';
        $this->form['pays']='';
    }

    public function changeEtat($etat){
        $this->status = $etat;
    }

    public function store(){
        // Client::create([
        //     'nom' => $this->form['nom'],
        //     'adresse' => $this->form['adresse'],
        //     'tel' => $this->form['tel'],
        //     'email' => $this->form['email'],
        //     'pays' => $this->form['pays'],
        // ]);

        $this->astuce->addHistorique("Ajout client", "add");
        $this->dispatchBrowserEvent("addSuccessful");
        $this->status="listClients";

        $this->initForm();
    }

    public function render()
    {
        return view('livewire.commercial.clients',
        [
            "country" => Country::orderBy('nom_fr', 'ASC')->get(),
        ])->layout('layouts.app', [
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
