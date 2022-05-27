<?php

namespace App\Http\Livewire;

use App\Models\Astuce;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class General extends Component
{
    use WithFileUploads;

    public $data = [
        'icon',
        'logo',
        'name'
    ];

    public $icon;
    public $astuce;
    public $logo;
    public $name;

    protected $messages = [
        'name.required' => 'Le nom est obligatoire',
        'name.max' => 'Maximum 18 caractéres',
        'icon.image' => 'Veuillez choisir une image',
        'icon.icon' => 'Veuillez choisir une image',
    ];

    public function editConfig()
    {
        $path = base_path('.env');

        if (Auth::user()->role === "Super Admin") {

            if (isset($name)) {
                $this->validate([
                    'name' => 'required|max:18'
                ]);

                $newName = explode(" ",trim($this->form['name']));
                $newName = implode("", $newName);

                if (file_exists($path)) {
                    file_put_contents($path, str_replace(
                        'APP_NAME=' . config('app.name'),
                        'APP_NAME=' . $newName,
                        file_get_contents($path)
                    ));
                }
            }

            if ($this->logo) {
                $this->validate([
                    'logo' => 'image'
                ]);
                $imageName = 'logo.jpg';

                $this->logo->storeAs('public/images', $imageName);

                if (file_exists($path)) {
                    file_put_contents($path, str_replace(
                        'APP_LOGO=' . config('app.logo'),
                        'APP_LOGO=' . $imageName,
                        file_get_contents($path)
                    ));
                }
            }

            if ($this->icon) {
                $this->validate([
                    'icon' => 'image'
                ]);
                $imageName = 'icon.jpg';

                $this->icon->storeAs('public/images', $imageName);

                if (file_exists($path)) {
                    file_put_contents($path, str_replace(
                        'APP_ICON=' . config('app.icon'),
                        'APP_ICON=' . $imageName,
                        file_get_contents($path)
                    ));
                }
            }
            $this->dispatchBrowserEvent("editSuccessfulSuperAdmin");

        } else {
            $this->validate([
                'name' => 'required|max:18'
            ]);

            $en = Entreprise::where('id', Auth::user()->entreprise_id)->first();
            $en->nom = $this->name;
            if ($this->logo) {
                $this->validate([
                    'logo' => 'image'
                ]);
                $imageName = 'company'.\md5($en->id).'jpg';

                $this->logo->storeAs('public/images', $imageName);

                $en->profil = $imageName;

            }
            $en->save();
            $this->dispatchBrowserEvent("editSuccessfulAdmin");

        }
        $this->init();
        $this->astuce->addHistorique("Mis à jour du système", "update");

    }

    public function render()
    {
        $this->astuce = new Astuce();

        return view('livewire.general')->layout('layouts.app', [
            'title' => "Configuration Générale",
            "page" => "general",
            "icon" => "fa fa-wrench"
        ]);
    }

    public function mount(){
        if(!Auth::user()){
            return redirect(route('login'));
        }

        $this->init();
    }

    public function init()
    {
        if (Auth::user()->role === 'Super Admin') {
            $this->data['icon'] =  config('app.icon');
            $this->data['logo'] =  config('app.logo');
            $this->data['name'] =  config('app.name');

        }else{
            $this->data['logo'] =  Auth::user()->entreprise->profil;
            $this->data['name'] =  Auth::user()->entreprise->nom;

        }
        $this->name = $this->data['name'];
        $this->logo = null;
        $this->icon = null;
    }
}
