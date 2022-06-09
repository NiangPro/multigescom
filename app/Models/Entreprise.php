<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $table = "entreprises";

    protected $fillable = [
        'nom',
        'sigle',
        'tel',
        'email',
        'adresse',
        'statut',
        'profil',
        'fermeture'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function staticDatas()
    {
        return $this->hasMany(StaticData::class);
    }

    public function employes()
    {
        return $this->hasMany(Employe::class);
    }

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class);
    }

    public function reunions()
    {
        return $this->hasMany(Reunion::class);
    }

    public function prospects()
    {
        return $this->hasMany(Prospect::class);
    }
}
