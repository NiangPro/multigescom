<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table="countries";

    protected $fillable = [
        'alpha2',
        'alpha3',
        'nom_en',
        'nom_fr',
    ];

    public function client()
    {
        return $this->hasMany(Client::class);
    }

    public function fournisseur()
    {
        return $this->hasMany(Fournisseur::class);
    }
}
