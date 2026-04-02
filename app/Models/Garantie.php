<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantie extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'description',
    ];

    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_garantie')->withTimestamps();
    }
}
