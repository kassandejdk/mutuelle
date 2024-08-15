<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Justificatif extends Model
{
    use HasFactory;
    protected $fillable=['libelle','fichier','demande_id'];

    public function getUrl()
    {
        // return Storage::disk('public')->url($this->fichier);
        return asset('storage/'.$this->fichier);
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
    
}
