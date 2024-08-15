<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pret;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paiement>
 */
class PaiementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'transId' => $this->faker->uuid,
                'token' => $this->faker->uuid,
               'montant' => $this->faker->randomFloat(2, 100, 1000),
               'statut'=>'completed',
                'pret_id' => Pret::factory(),
        ];
    }
}
