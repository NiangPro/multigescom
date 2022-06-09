<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $table = "employes";

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'tel',
        'fonction',
        'adresse',
        'sexe',
        'profil',
        'pays',
        'entreprise_id',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, "entreprise_id");
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function prospects()
    {
        return $this->hasMany(Prospect::class);
    }
}
