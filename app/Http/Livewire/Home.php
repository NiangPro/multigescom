<?php

namespace App\Http\Livewire;



use App\Models\Astuce;
use App\Models\Todolist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Home extends Component
{
    public $astuce;
    public $todo = "list";
    public $current_todo;
    use WithFileUploads, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $dataSuperAdmin = [
        'nbreEntreprise',
        'nbreSuperAdmin',
        'nbreAdmin',
    ];

    public $todoForm = [
        'id'=>null,
        'titre'=>'',
        'date'=>'',
        'statut'=>'',
        'user_id'=>null
    ];

    protected $rules = [
        'todoForm.titre' => 'required|string',
        'todoForm.date' => 'required|string',
        'todoForm.statut' => 'required|string',
    ];

    protected $messages = [
        'todoForm.titre' => 'Le titre est requis',
        'todoForm.date' => 'La date est requise',
        'todoForm.statut' => 'Le statut est requis',
    ];

    protected $listeners = ['remove'];


    public function formadd()
    {
        $this->todo = "add";
        $this->dispatchBrowserEvent('swal:add');
    }

    public function backTodo()
    {
        $this->todo = "list";
    }

    public function getTodo($id){
        $this->todoFormInit();
        $this->current_todo = Todolist::where('id', $id)->first();

        $this->todoForm['titre']=$this->current_todo->titre;
        $this->todoForm['date']=$this->current_todo->date;
        $this->todoForm['statut']=$this->current_todo->statut;
        $this->todoForm['user_id']=$this->current_todo->user_id;
        $this->todo = "add";
    }

    public function addTodo(){
        $this->validate();
        if(isset($this->current_todo->id) && $this->current_todo->id!==null){
            $this->current_todo->titre = $this->todoForm['titre'];
            $this->current_todo->date = $this->todoForm['date'];
            $this->current_todo->statut = $this->todoForm['statut'];

            $this->current_todo->save();

            $this->astuce->addHistorique("Mis à jour des informations à faire", "update");

            $this->dispatchBrowserEvent("updateSuccessful");
            $this->getTodo($this->current_todo->id);

            $this->todo = "list";
        }else{
            Todolist::create([
                'titre' => $this->todoForm['titre'],
                'date' => $this->todoForm['date'],
                'statut' => $this->todoForm['statut'],
                'user_id'=> Auth()->user()->id,
            ]);
    
            $this->astuce->addHistorique("Ajout à faire ->".$this->todoForm['titre'], "add");
    
            $this->dispatchBrowserEvent("addSuccessful");
            $this->todoFormInit();
    
            $this->todo = "list";
        }  
    }

    public function delete($id)
    {
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

    public function remove()
    {

        $todolist = Todolist::where('id', $this->idDeleting)->first();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'A faire!',
                'text' => 'Suppression avec succès.'
            ]);

            $todolist->delete();
            $this->todo= "list";

    }

    public function todoFormInit(){
        $this->todoForm['id']=null;
        $this->todoForm['titre']='';
        $this->todoForm['date']='';
        $this->todoForm['statut']='';
        $this->todoForm['user_id']=null;
    }


    public function render()
    {

        $this->dataSuperAdmin['nbreEntreprise'] = count($this->astuce->entreprises());
        $this->dataSuperAdmin['nbreSuperAdmin'] = count($this->astuce->superAdmins());
        $this->dataSuperAdmin['nbreAdmin'] = count($this->astuce->admins());

        return view('livewire.home', [
            'todolists' => Todolist::orderBy('id', 'DESC')->paginate(5),
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
