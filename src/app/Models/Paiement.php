<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable=['transId','token','montant','pret_id','statut'];
    protected $primaryKey='transId';
    public $incrementing=false;
    protected $keyType='string';

    public function pret()
    {
        return $this->belongsTo(Pret::class);
    }
}
