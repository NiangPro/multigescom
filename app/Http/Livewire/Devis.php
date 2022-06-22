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
            'client_id' => $this->form['client_id'],
            'employe_id' => $this->form['employe_id'],
            'description' => $this->form['description'],
            'montant' => $this->form['montant'],
            'remise' => $this->form['remise'],
            'date' => $this->form['date'],
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
        foreach ($this->tab_product as $product) {
            if($product['nom']==="" && $product['description']==="" &&
            $product['tarif']===0 && $product['quantite']=== 0){
                $this->dispatchBrowserEvent("elementEmpty");
            }else{
                $this->tab_product[] = [
                    'nom'=>"",
                    'description'=>"",
                    'tarif' =>0,
                    'quantite'=>0,
                    'taxe'=>0,
                    'montant'=>0,
                ];
            }
        }
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

    public function changeEvent($id){
        if($id !== null){
            
            array_pop($this->tab_product);
            $product = Produit::where("id", $id)->first();

            $this->tab_product[] = [
                'nom'=> $product->nom,
                'description'=> $product->description,
                'tarif' => $product->tarif,
                'quantite'=> 1,
                'taxe'=> $product->taxe,
                'montant'=> $product->tarif,
            ];


        }
    }

    public function montanthT($tarif, $qt , $tva){
        return ($tarif*$qt*($tva/100));
    }

    public function calculMontant($key){
        $this->tab_product[$key]['montant'] = $this->montanthT(
            $this->tab_product[$key]['tarif'], 
            $this->tab_product[$key]['quantite'], 
            $this->tab_product[$key]['taxe']
        ) ;
    }
 
    public function render()
    {
        $this->astuce = new Astuce();
        $sous_total = 0;

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

    public function initTabProduct(){
        $this->tab_product[] = [
            'nom'=>"",
            'description'=>"",
            'tarif' =>0,
            'quantite'=>0,
            'taxe'=>0,
            'montant'=>0,
        ];
    }

    public function mount(){
        if(!Auth::user()){
            
            return redirect(route('login'));
        }

        if(Auth::user()->isCommercial()){
            
            return redirect(route("home"));
        }

        $this->initTabProduct();

    }
}
