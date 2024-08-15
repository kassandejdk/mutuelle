<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Demande>
 */
class DemandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'motif' => $this->faker->text(15),
            'statut' => 'en traitement',
            'description' => $this->faker->text(100),
            'montant' => $this->faker->randomFloat(2, 0, 1000),
            'user_id' => User::factory(),
        ];
    }
}
