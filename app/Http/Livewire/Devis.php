<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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

    public function addItem()
    {
        // $i = $i + 1;
        // $this->i = $i;
        // array_push($this->tab_product ,$i);
        $this->tab_product[] = [
            // 'id'=>'',
            'nom'=>'',
            'description'=>'',
            'montant'=>null,
            'taxe'=>null,
            'quantite'=>1,
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
            $this->item_product = Produit::where("id", $value)->first();
            // dump($this->tab_product[count($this->tab_product)-1]);
            
            if(count($this->tab_product)>=0){
                // $this->tab_product[count($this->tab_product)-1]['id'] = $this->item_product->id;
                $this->tab_product[count($this->tab_product)-1]['nom'] = $this->item_product->nom;
                $this->tab_product[count($this->tab_product)-1]['description'] = $this->item_product->description;
                $this->tab_product[count($this->tab_product)-1]['montant'] = $this->item_product->tarif;
                $this->tab_product[count($this->tab_product)-1]['taxe'] = $this->item_product->taxe;
                $this->tab_product[count($this->tab_product)-1]['quantite'] = $this->item_product->quantite;
            }
            
        }
    }

    public function render()
    {
        $total = 0;

        foreach ($this->tab_product as $product) {
           if($product['montant'] && $product['quantite']){
                $total += $product['montant'] * $product['quantite'];
           }
        }

        return view('livewire.comptable.devis',[
            'all_product' => Produit::OrderBy('id', 'DESC')->get(),
            'total' => $total,
            'sous_total' => $total * (1 + (is_numeric(10) ? 10 : 0)/100),
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
    
            'nom'=>'',
            'description'=>'',
            'montant'=>0,
            'taxe'=>0,
            'quantite'=>1,
        ];

    }
}
