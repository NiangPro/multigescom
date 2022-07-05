<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Depense;
use App\Models\Vente;
use App\Models\VenteItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Rapports extends Component
{
    public $depenses;
    public $ventes;
    public $astuce;
    public $venteMonth;
    public $depenseMonth;
    public $revenus;
    public $revenusTotal;
    public $venteTotal;
    public $depenseTotal;

    public $form = [
        'date_debut' => '',
        'date_fin' => ''
    ];

    protected $rules = [
        'form.date_debut' => 'required|date',
        'form.date_fin' => 'required|date',
    ];

    protected $messages = [
        'form.date_debut.required' => 'Le date début est requise',
        'form.date_fin.required' => 'La date fin est requise',
    ];

    public function search(){
        if($this->validate()){
            if($this->form['date_debut']>$this->form['date_debut']){
                $this->dispatchBrowserEvent("errorDate");
            }else{
                $depense = Depense::where('date', $this->form['date_debut'],'>=')->where('date', $this->form['date_fin'],'<=')
                ->select([DB::raw("SUM(montant) as amount"), 
                DB::raw("DATE_FORMAT(date, '%m') as month"),
                DB::raw("DATE_FORMAT(date, '%Y') as year"),])->groupBy('month')->groupBy('year')->get();
                dd($depense);
            }
        }
    }
    
    public function render()
    {
        $this->astuce = new Astuce();
        $this->ventes = json_encode(Vente::get('montant')->pluck('montant'));
        
        $this->depenses = $this->astuce->getDepenses();
        $this->ventes = $this->astuce->getVentes();
        $this->depenseMonth = $this->astuce->getDepensesMonth();
        $this->venteMonth = $this->astuce->getVentesMonth();

        $depense = json_decode($this->astuce->getDepensesMonth());
        $vente = json_decode($this->astuce->getVentesMonth());

        $this->depenseTotal = $depense[0];
        $this->venteTotal = $vente[0];
        $this->revenusTotal = $this->venteTotal-$this->depenseTotal;
        

        
        
        return view('livewire.comptable.rapports')->layout('layouts.app', [
            'title' => "Les Rapports",
            "page" => "rapport",
            "icon" => "fas fa-chart-bar"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

        if(Auth::user()->isCommercial()){
            return redirect(route("home"));
        }

    }
}
