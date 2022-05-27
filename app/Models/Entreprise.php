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
}
