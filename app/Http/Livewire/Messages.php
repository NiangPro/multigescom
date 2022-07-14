<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Messages extends Component
{
    public function render()
    {
        return view('livewire.messages')->layout('layouts.app', [
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
