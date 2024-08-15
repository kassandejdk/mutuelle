<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demande extends Model


{
    use HasFactory;

    protected $table ='demandes';
    protected $fillable = [
        'motif',
        'description',
        'statut',
        'montant',
        'user_id',
    ];

    

    public function pret(){
        return $this->hasOne(Pret::class);
    }

    public function contrat():HasOne
    {
        return $this->hasOne(Pret::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function justificatifs(){
        return $this->hasMany(Justificatif::class);
    }
}
