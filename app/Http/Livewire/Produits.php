<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
    }

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
