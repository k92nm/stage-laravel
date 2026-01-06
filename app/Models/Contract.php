<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    // Cette ligne est indispensable pour autoriser l'enregistrement via le formulaire
    protected $fillable = [
        'client_id', 
        'company_name', 
        'policy_number', 
        'type', 
        'start_date', 
        'end_date', 
        'premium_amount'
    ];

    // Petite astuce : on définit la relation inverse pour que le contrat sache à quel client il appartient
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}