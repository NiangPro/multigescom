<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Messenger;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Messages extends Component
{
    public $idUser=null;
    public $current_user;
    public $astuce;
    public $recent_message;
    public $current_message = null;

    public $form =[
        'emetteur_id' => '',
        'recepteur_id' => '',
        'text' => '',
        'seen' => '',
        'statut' => ''
    ];

    protected $rules = [
        'form.text' => 'required|string',
    ];

    protected $messages = [
        'form.text.required' => 'Le text est requis'
    ];

    public function initForm(){
        $this->form['text']='';
    }

    public function store(){
        $this->validate();
        if(isset($this->current_user->id) && $this->current_user->id !== null){
            Messenger::create([
                'emetteur_id' => Auth::user()->id,
                'recepteur_id' => $this->current_user->id,
                'text'=> $this->form['text']
            ]);

            $this->astuce->addHistorique("Ajout Message", "add");
            $this->initForm();
        }
    }

    public function selectedMessages($idReceved){
        $this->current_message = Messenger::where('recepteur_id', $idReceved)->Where('emetteur_id', Auth::user()->id)
            ->orWhere('emetteur_id', $idReceved)->Where('recepteur_id', Auth::user()->id)->orderBy('created_at', 'ASC')->get();
        // dd($this->current_message);
    }

    public function changeEvent(){
        $this->current_user = User::where('id', $this->idUser)->first();
        $this->selectedMessages($this->idUser);

        if($this->current_message == null){
            $this->current_message = null;
            // $this->idUser = null;
        }
    }

    public function selectEvent($idReceved){
        $this->current_user = User::where('id', $idReceved)->first();
        $this->selectedMessages($idReceved);
    }

    public function render()
    {
        $this->astuce = new Astuce();
        $this->recent_message = $this->astuce->getLastedUsersDiscussions();
        return view('livewire.messages',[
            'users' => User::where('entreprise_id', Auth::user()->entreprise_id)->where('id', '!=' ,Auth::user()->id)->get(),
            ])->layout('layouts.app', [
            'title' => "Les Messages",
            "page" => "message",
            "icon" => "fa fa-envelope-open"
        ]);

    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }
    }
}
