<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Client;
use App\Models\DevisItem;
use App\Models\Devis as ModelsDevis;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Symfony\Component\Mailer\Transport\Dsn;

class Devis extends Component
{   
    public $etat;
    public $astuce;
    public $current_devis;
    public $idDeleting;
    protected $listeners = ['remove'];
    public $currentStep = 1;
    public $item_product;
    public $tab_product = [];
    public $i = 1;
    public $taxes;
    public $idItem=0;
    public $total=0;
    public $staticData;

    public $form = [
        'date' => '',
        'client_id' => '',
        'employe_id' => '',
        'description' => '',
        'montant' => '',
        'remise' => '',
        'statut' => '',
        'entreprise_id' => '',
    ];

    protected $rules = [
        'form.date' => 'required|string',
        'form.client_id' => 'required',
        'form.employe_id' => 'required',
        'form.statut' => 'required|string',
    ];

    protected  $messages = [
        'form.date.required' => 'La date est requis',
        'form.client_id.required' => 'Le client est requis',
        'form.employe_id.required' => 'L\'employe client est requis',
        'form.statut.required' => 'le statut est requis',
    ];

    public function initForm(){
        $this->form['date']='';
        $this->form['client_id']='';
        $this->form['employe_id']='';
        $this->form['description']='';
        $this->form['montant']='';
        $this->form['remise']='';
        $this->form['statut']='';
    }

    public function store(){
        $this->validate();

        ModelsDevis::create([
            'date' => $this->form['date'],
            'client_id' => $this->form['client_id'],
            'employe_id' => $this->form['employe_id'],
            'description' => $this->form['description'],
            'montant' => $this->form['montant'],
            'remise' => $this->form['remise'],
            'statut' => $this->form['statut'],
            'entreprise_id' => Auth::user()->entreprise_id,
        ]);

        foreach ($this->tab_product as $key => $value) {
            $this->$this->validate([
                $this->tab_product[$key]['nom'] =>'required|string',
                // $this->tab_product[$key]['decription'] =>'required|string',
                $this->tab_product[$key]['montant'] =>'required',
                // $this->tab_product[$key]['taxe'] =>'required|string',
                $this->tab_product[$key]['quantite'] =>'required'
            ],[
                $this->tab_product[$key]['nom'].'required' =>'Le nom est requis',
                $this->tab_product[$key]['montant'].'required' =>'le Montant est requis',
                $this->tab_product[$key]['quantite'].'required' =>'La quantité est requise'
            ]);

            DevisItem::create([
                'nom' => $this->tab_product[$key]['nom'],
                'description' => $this->tab_product[$key]['decription'],
                'montant' => $this->tab_product[$key]['montant'],
                'taxe' => $this->tab_product[$key]['taxe'],
                'quantite' => $this->tab_product[$key]['quantite'],
                'devis_id' => 1,
            ]);
        }
    }


    public function addItem()
    {
        $this->item_product = [];
        $this->tab_product[] = [
            'nom'=>"" ?? 'Nom',
            'description'=>"" ?? 'Description',
            'tarif' =>0,
            'quantite'=>0,
            'taxe'=>0,
            'montant'=>0,
        ];
    }
      
    public function removeItem($i)
    {
        unset($this->tab_product[$i]);
        $this->tab_product=array_values($this->tab_product);
    }

    public function firstStepSubmit()
    {
        $this->currentStep = 2;
    }

    public function back($step)
    {
        $this->currentStep = $step;    
    }

    public function changeEtat($etat){
        $this->etat = $etat;
    }

    public function changeEvent($value){
        if(isset($value) && $value !== null){
            $this->idItem = $value;
            // $this->item_product = Produit::where("id", $value)->first();
        }
    }

    public function calculMontant($tarif, $qt , $tva){
        return ($tarif*$qt*($tva/100));
    }

    public function render()
    {
        $this->astuce = new Astuce();
        $sous_total = 0;

        if($this->idItem!==0 && $this->idItem!==null){
            $this->item_product = Produit::where("id", $this->idItem)->first();
            if(count($this->tab_product)>=0 ){
                $this->tab_product[count($this->tab_product)-1]['nom'] = $this->item_product->nom;
                $this->tab_product[count($this->tab_product)-1]['description'] = $this->item_product->description;
                $this->tab_product[count($this->tab_product)-1]['tarif'] = $this->item_product->tarif;
                $this->tab_product[count($this->tab_product)-1]['quantite'] = 1;

                $this->tab_product[count($this->tab_product)-1]['montant'] = $this->calculMontant(
                    $this->tab_product[count($this->tab_product)-1]['tarif'],
                    $this->tab_product[count($this->tab_product)-1]['quantite'],
                    $this->tab_product[count($this->tab_product)-1]['taxe']
                );
            }
        }
        foreach ($this->tab_product as $product) {
           if($product['montant'] && $product['quantite']){
                $sous_total += ($product['montant'] * $product['quantite'])*(1 + ($product['taxe']/100));
                $this->total = $sous_total;
         }
        }

        $this->staticData = $this->astuce->getStaticData("Statut des devis");

        return view('livewire.comptable.devis',[
            'all_product' => Produit::OrderBy('id', 'DESC')->get(),
            'sous_total' => $sous_total,
            'total' => $this->total,
            'clients' => Client::orderBy('id', 'DESC')->get(),
            'employes' => User::where('entreprise_id', Auth::user()->entreprise_id)->orderBy('id', 'DESC')->get(),
        ])->layout('layouts.app', [
            'title' => "Les Devis",
            "page" => "devis",
            "icon" => "fas fa-file-invoice"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            
            return redirect(route('login'));
        }

        if(Auth::user()->isCommercial()){
            
            return redirect(route("home"));
        }

        $this->tab_product[] = [
            'nom'=>"" ?? 'Nom',
            'description'=>"" ?? 'Description',
            'tarif' =>0,
            'quantite'=>0,
            'taxe'=>0,
            'montant'=>0,
        ];

    }
}
