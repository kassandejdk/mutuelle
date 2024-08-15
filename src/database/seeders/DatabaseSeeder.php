<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\Justificatif;
use App\Models\Pret;
use App\Models\Paiement;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Demande::factory(3)->create();
        Pret::factory(10)->create();
        Paiement::factory(10)->create();
        DB::table('roles')->insert([
            ['libelle'=>'adherant'],
            ['libelle'=>'membre'],
            ['libelle'=>'operateur'],
            ['libelle'=>'admin'],
          
        ]);

        $user=User::create([
            'nom' => 'KASSANDE',
            'prenom' => 'Judicael ',
            'email' => 'delwende@gmail.com',
            'cnib' => 'aaa',
            'matricule'=>'M0240001',
            'password'=>Hash::make('delwende'),
        ]);
        
        $user->roles()->attach([2,3]);
    }
}
