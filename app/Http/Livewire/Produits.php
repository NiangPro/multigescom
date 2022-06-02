<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Produits extends Component
{
    public function render()
    {
        return view('livewire.commercial.produits')->layout('layouts.app',[
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
