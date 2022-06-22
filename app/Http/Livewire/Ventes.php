<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Client;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ventes extends Component
{
    public $etat;
    public $astuce;
    public $current_vente;
    public $idDeleting;
    protected $listeners = ['remove'];
    public $currentStep = 1;
    public $idProd = null;
    public $staticData;
    public $tab_product = [];

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

    public function changeEvent(){
        if($this->idProd !== null){

            array_pop($this->tab_product);
            $product = Produit::where("id", $this->idProd)->first();

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

    public function render()
    {
        $this->astuce = new Astuce();
        $this->staticData = $this->astuce->getStaticData("Statut des devis");

        return view('livewire.comptable.ventes',[ 
            'all_product' => Produit::OrderBy('id', 'DESC')->get(),
            'clients' => Client::orderBy('id', 'DESC')->get(),
            'employes' => User::where('entreprise_id', Auth::user()->entreprise_id)->orderBy('id', 'DESC')->get(),
        ]
        )->layout('layouts.app', [
            'title' => "Les Ventes",
            "page" => "vente",
            "icon" => "fa fa-shopping-cart"
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
