<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Astuce;
use App\Models\Produit;


class Produits extends Component
{

    protected $listeners = ['remove'];

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'User Created Successfully!',
                'text' => 'It will list on users table soon.'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'message' => 'Are you sure?',
                'text' => 'If deleted, you will not be able to recover this imaginary file!'
            ]);
    }

    public function remove()
    {
        /* Write Delete Logic */
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'User Delete Successfully!',
                'text' => 'It will not list on users table soon.'
            ]);
    public $status = "listProduct";
    public $tva;
    public $astuce;
    public $current_produit;

    public $form = [
        'nom' => '',
        'description' => '',
        'type' => '',
        'tarif' => '',
        'taxe' => '',
        'entreprise_id' => '',
    ];

    protected $rules = [
        'form.nom' => 'required|string',
        'form.description' => 'required|string',
        'form.type' => 'required|string',
        'form.tarif' => 'required',
        'form.taxe' => 'required',
    ];

    protected $messages = [
        'form.nom.required' => 'Le nom est requis',
        'form.description.required' => 'La description est requise',
        'form.type.required' => 'Le type est requis',
        'form.tarif.required' => 'Le tarif est requis',
        'form.taxe.required' => 'La taxe est requise',
    ];

    public function getProduct($id){
        $this->status="editProduct";
        $this->initForm();

        $this->current_produit = Produit::where('id', $id)->first();
        $this->form['id'] = $this->current_produit->id;
        $this->form['nom'] = $this->current_produit->nom;
        $this->form['description'] = $this->current_produit->description;
        $this->form['type'] = $this->current_produit->type;
        $this->form['tarif'] = $this->current_produit->tarif;
        $this->form['taxe'] = $this->current_produit->taxe;
    }

    public function store(){
        $this->validate();
        if(empty($this->form['type'])){
            $this->dispatchBrowserEvent("typeEmpty");
        }
        
        if(isset($this->current_produit->id) && $this->current_produit->id !== null){
            $produit = Produit::where("id", $this->current_produit->id)->first();

            $produit->nom = $this->form['nom'];
            $produit->description = $this->form['description'];
            $produit->type = $this->form['type'];
            $produit->tarif = $this->form['tarif'];
            $produit->taxe = $this->form['taxe'];

            $produit->save();
            $this->astuce->addHistorique("Mis à jour produit ou service", "update");
            $this->dispatchBrowserEvent("updateSuccessful");
            $this->status =  "listProduct";
            $this->initForm();

        }else{

            Produit::create([
                'nom' => $this->form['nom'],
                'description' => $this->form['description'],
                'type' => $this->form['type'],
                'tarif' => $this->form['tarif'],
                'taxe' => $this->form['taxe'],
                'entreprise_id' => Auth::user()->entreprise_id,
            ]);
        
                $this->astuce->addHistorique("Ajout produit", "add");
                $this->dispatchBrowserEvent("addSuccessful");
                $this->status =  "listProduct";
                $this->initForm();
        }
    }

    public function initForm(){
        $this->form['nom']='';
        $this->form['description']='';
        $this->form['type']='';
        $this->form['tarif']='';
        $this->form['taxe']='';
    }

    public function changeEtat($etat){
        $this->status = $etat;
    }

    public function render()
    {
        $this->astuce = new Astuce();
        $this->tva = $this->astuce->getStaticData("TVA");

        return view('livewire.commercial.produits', [
            "produits" => Produit::orderBy('id','DESC')->get(),
        ])->layout('layouts.app',[
            'title' => 'Produits & Services',
            "page" => "produit",
            "icon" => "fab fa-product-hunt"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }
    }
}
