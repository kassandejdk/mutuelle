<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='users';
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'cnib',
        'matricule',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function hasRole($role){
        return $this->roles->contains($role);
    }

    public function getAvatar()
    {
        return $this->avatart?Storage::url($this->avatar) :asset('images/avatar.png');
    }

    public  static function demandeInscription(){
        return self::whereNull('matricule')
                ->whereDoesntHave('roles',function ($query){
                    $query->where('id',5);
                } )
                ->get();
    }

    public static function matriculeExiste($matricule){
        return self::where('matricule',$matricule)->exists();
    }
    
    public static function getMatricule()
    {
        $year = date('Y'); 
        $three=substr($year,-3);
        $prefix = 'M' . $three; 

        do {
            
            $number = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT); 
            $matricule = $prefix . $number;
        } while (self::matriculeExiste($matricule));

        return $matricule;
    }
    
    public function demandes(){
        return $this->hasMany(Demande::class);
    }

    public function prets(){
        return $this->hasManyThrough(Pret::class,Demande::class)
        ->where('est_accepter',1);
    }
}
