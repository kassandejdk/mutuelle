<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pret extends Model
{
    use HasFactory;
    protected $table ='prets';
    protected $fillable=[
        'montant',
        'taux',
        'demande_id',
        'delais',
        'reste_a_payer',
        'est_accepter',
    ];
    
    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
    public function paiements(){
        return $this->hasMany(Paiement::class);
    }
    public function scopeFini(Builder $query)
    {
        $query->where('reste_a_payer','<=',0);
    }
}
