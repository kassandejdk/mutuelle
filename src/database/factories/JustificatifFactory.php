<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Demande;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Justificatif>
 */
class JustificatifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->sentence(3, true),
            'fichier' => $this->generateFile(),
            'demande_id' => Demande::factory(),
        ];
    }

    private function generateFile()
    {
        $fileType = rand(0, 1); 
        $filePath = '';
    
        if ($fileType === 0) {
            $filePath = $this->faker->image('storage/app/public/files', 640, 480, null, false);
            $filePath = 'storage/files/' . $filePath; 
        } else {
            $fileName = Str::random(10) . '.pdf';
            $pdfContent = $this->faker->text(500); 
            $filePath = 'storage/files/' . $fileName;
            \Storage::put($filePath, $pdfContent);
        }
    
        return $filePath;
    }
   
}
