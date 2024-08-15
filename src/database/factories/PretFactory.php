<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Demande;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pret>
 */
class PretFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'montant' => $this->faker->randomFloat(2, 100, 1000),
            'reste_a_payer' => $this->faker->randomFloat(2, 0, 1000),
            'taux' => $this->faker->randomFloat(2, 0, 10),
            'delais' => $this->faker->date(),
            'est_accepter' => $this->faker->boolean(),
            'demande_id' => Demande::factory(),
        ];
    }
}
