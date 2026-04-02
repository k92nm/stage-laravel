<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ICI : L'importation manquante
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Pour autoriser le remplissage des champs grace a un formulaire
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'adress',
        'city',
        'zip_code'
    ];

    //Relation : Un client peut avoir plusieurs contrats
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

}
