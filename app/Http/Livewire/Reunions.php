<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Reunion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reunions extends Component
{
    public $status = "listReunions";
    public $current_meet;
    public $astuce;
    public $idDeleting;
    protected $listeners = ['remove'];

    public $form = [
        'titre' => '',
        'date' => '',
        'description' => '',
        'entreprise_id' => '',
    ];

    protected $rules = [
        'form.titre' => 'required|string',
        'form.date' => 'required|date',
        'form.description' => 'required|string',
    ];

    protected $messages = [
        'form.titre.required' => 'Le nom est requis',
        'form.date.required' => 'La date est requis',
        'form.description.required' => 'la description est requise',
    ];

    public function changeEtat($etat){
        $this->status = $etat;
    }

    public function initForm(){
        $this->form['titre']='';
        $this->form['description']='';
        $this->form['date']='';
    }

    public function getReunion($id){
        $this->status="editReunion";
        $this->initForm();

        $this->current_meet = Reunion::where('id', $id)->first();
        $this->form['id'] = $this->current_meet->id;
        $this->form['titre'] = $this->current_meet->titre;
        $this->form['description'] = $this->current_meet->description;
        $this->form['date'] = $this->current_meet->date;
    }

    // add end edit reunion
    public function store(){
        $this->validate();
        if (isset($this->current_meet->id) && $this->current_meet!== null) {
            $reunion = Reunion::where("id", $this->current_meet->id)->first();

            $reunion->titre = $this->form['titre'];
            $reunion->description = $this->form['description'];
            $reunion->date = $this->form['date'];

            $reunion->save();
            $this->astuce->addHistorique("Mis à jour reunin", "update");
            $this->dispatchBrowserEvent("addSuccessful");
            $this->status="listReunions";

            $this->initForm();
        }else{
            Reunion::create([
                'titre' => $this->form['titre'],
                'description' => $this->form['description'],
                'date' => $this->form['date'],
                'entreprise_id' => Auth::user()->entreprise_id,
            ]);
    
            $this->astuce->addHistorique("Ajout reunion", "add");
            $this->dispatchBrowserEvent("addSuccessful");
            $this->status="listReunions";
    
            $this->initForm();
        }

    }

    public function delete($id){
        $this->idDeleting = $id;
        $this->alertConfirm();
    }

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Êtes-vous sûr?',
            'text' => 'Vouliez-vous supprimer?'
        ]);
    }

    // delete reunion
    public function remove(){
        $reunion = Reunion::where("id", $this->current_meet->id)->first();
        $reunion->delete();

        $this->astuce->addHistorique('Suppression d\'une reunion', "delete");
        /* Write Delete Logic */

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Reunion',
            'text' => 'Suppression avec succéss!.'
        ]);
    }

    public function render()
    {
        $this->astuce = new Astuce();
        return view('livewire.commercial.reunions',
            [
                "reunions" => Reunion::orderBy('id', 'DESC')->get(),
            ]
        )->layout('layouts.app', [
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
