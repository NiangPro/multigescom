<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Contrat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Country;
use App\Models\Employe;
use Livewire\WithFileUploads;

class Employes extends Component
{
    use WithFileUploads;

    public $etat = "list";
    public $statut= "info";
    public $staticData;
    public $astuce;
    public $employes = [];
    public $current_employe;
    public $profil;
    public $showDiv=false;
    public $showDoc=false;
    public $doc = 1;
    public $file_name;
    public $contrats;
    public $document;

    public function changeEtat(){

        if($this->etat === 'list'){
            $this->etat = "add";
            $this->initForm();
        }else {
            $this->etat = "list";
        }
    }

    public function changeStatut(){
        if($this->statut === 'info'){
            $this->statut = "contrat";
            $this->changePosition();
        }else {
            $this->statut = "info";
            $this->changePosition();
        }
    }

    public functiOn changePosition(){
        $this->doc = $this->doc=== 0 ? 1 : 0;
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
        'id' => null,
    ];

    public $contratForm = [
        'id'=> null,
        'titre'=> '',
        'fichier'=> '',
        'employe_id'=> '',
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
        'form.pays.required' => 'Le pays est requis',
    ];

    public function deleteDocument($id){
        $this->showDoc =! $this->showDoc;
        $this->document = Contrat::where('id', $id)->first();
    }

    public function removeDocument(){
        $doc =  Contrat::where('id', $this->document->id)->first();
        $this->astuce->addHistorique('Suppression d\'un document ('.$this->document->titre.')', "delete");
        $doc->delete();
        $this->dispatchBrowserEvent('deleteSuccessful');

        $this->current_employe = Employe::where('id', $this->current_employe->id)->first();

    }

    public function addDocument(){
        if(isset($this->current_employe->id) && $this->current_employe->id !== null){
            $this->validate([
                'contratForm.titre'=>'required',
                'contratForm.fichier'=>'required|file',
            ]);

            $fileName = 'contrat_'.uniqid().'.pdf';

            $this->contratForm['fichier']->storeAs('public/contrats', $fileName);

            Contrat::create([
                'titre' => $this->contratForm['titre'],
                'fichier' => $fileName,
                'employe_id' => $this->current_employe->id,
            ]);

            $this->astuce->addHistorique("Ajout document", "add");
            $this->dispatchBrowserEvent("addSuccessful");
            $this->changePosition();
            $this->initContratForm();

            $this->current_employe = Employe::where('id', $this->current_employe->id)->first();

        }
    }

    public function initContratForm(){
        $this->contratForm['titre']='';
        $this->contratForm['fichier']='';
        $this->contratForm['employe_id']='';

    }


    public function delete($id)
    {
        $this->showDiv =! $this->showDiv;
        $this->current_employe = Employe::where('id', $id)->first();
    }

    public function remove(){

        $employe = Employe::where('id', $this->current_employe->id)->first();
        $this->astuce->addHistorique('Suppression d\'un employé ('.$this->current_employe->prenom.' '.$this->current_employe->nom.')', "delete");
        $employe->delete();
        $this->dispatchBrowserEvent('deleteSuccessful');

    }

    public function getEmploye($id){
        $this->etat="info";
        $this->initForm();

        $this->current_employe = Employe::where('id', $id)->first();
        $this->form['id'] = $this->current_employe->id;
        $this->form['prenom'] = $this->current_employe->prenom;
        $this->form['nom'] = $this->current_employe->nom;
        $this->form['email'] = $this->current_employe->email;
        $this->form['tel'] = $this->current_employe->tel;
        $this->form['fonction'] = $this->current_employe->fonction;
        $this->form['adresse'] = $this->current_employe->adresse;
        $this->form['sexe'] = $this->current_employe->sexe;
        $this->form['pays'] = $this->current_employe->pays;

    }

    public function deleteEmploye($id){
        $employe = Employe::where("id", $id)->first();
        $employe->delete();

        $this->astuce->addHistorique('Suppression d\'un employé', "delete");
        $this->dispatchBrowserEvent('deleteSuccessful');
    }

    public function initForm(){
        $this->form['prenom']='';
        $this->form['nom']='';
        $this->form['email']='';
        $this->form['tel']='';
        $this->form['fonction']='';
        $this->form['adresse']='';
        $this->form['sexe']='';
        $this->form['pays']='';
    }

    public function editProfil()
    {
        if ($this->profil) {
            $this->validate([
                'profil' => 'image'
            ]);
            $imageName = 'employe'.\md5($this->current_employe->id).'jpg';

            $this->profil->storeAs('public/images', $imageName);

            $employe = Employe::where('id', $this->current_employe->id)->first();

            $employe->profil = $imageName;
            $employe->save();

            $this->astuce->addHistorique('Changement de logo d\'un employé', "update");

            $this->profil = "";
            $this->dispatchBrowserEvent('profilEditSuccessful');
            $this->getEmploye($this->current_employe->id);
        }
    }


    public function store(){

        $this->validate();

        if(isset($this->current_employe->id) && $this->current_employe->id !== null){
            $employe = Employe::where("id", $this->current_employe->id)->first();


            $employe->prenom = $this->form['prenom'];
            $employe->nom = $this->form['nom'];
            $employe->email = $this->form['email'];
            $employe->tel = $this->form['tel'];
            $employe->fonction = $this->form['fonction'];
            $employe->adresse = $this->form['adresse'];
            $employe->sexe = $this->form['sexe'];
            $employe->pays = $this->form['pays'];

            $employe->save();
            $this->astuce->addHistorique("Mis à jour employé", "update");
            $this->dispatchBrowserEvent("updateSuccessful");
            $this->initForm();
        }else{

            Employe::create([
                'prenom' => $this->form['prenom'],
                'nom' => $this->form['nom'],
                'email' => $this->form['email'],
                'tel' => $this->form['tel'],
                'adresse' => $this->form['adresse'],
                'pays' => $this->form['pays'],
                'fonction' => $this->form['fonction'],
                'entreprise_id' => Auth::user()->entreprise_id,
                'sexe' => $this->form['sexe'],
                'profil' => $this->form['sexe'] === 'Homme' ? 'user-male.png' : 'user-female.png',

            ]);

            $this->astuce->addHistorique("Ajout employé", "add");
            $this->dispatchBrowserEvent("addSuccessful");
            $this->changeEtat();

            $this->initForm();
        }
    }

    public function render()
    {
        $this->astuce = new Astuce();
        $this->staticData = $this->astuce->getStaticData("Type de fonction");

        $this->employes = Employe::orderBy('id', 'DESC')->get();
        return view('livewire.admin.employes', [
            "country" => Country::orderBy('nom_fr', 'ASC')->get(),
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
