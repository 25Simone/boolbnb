<?php

use App\AdditionalService;
use Illuminate\Database\Seeder;

class AdditionalServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Additional services list
        $services = [
            [
                "name"=> "Piscina",
                "description" => "Piscina disponibile e gratuita nella struttura."
            ],
            [
                "name"=> "Tv",
                "description" => "Tv schermo piatto disponibile e gratuito."
            ],
            [
                "name"=> "Aria condizionata",
                "description" => "Sistema di climatizzazione presente nell'appartamento"
            ],
            [
                "name"=> "Cucina",
                "description" => "Cucina attrezzata presente nell'appartamento."
            ],
            [
                "name"=> "Asciugacapelli",
                "description" => "Asciugacapelli gratuito disponibile in stanza."
            ],
            [
                "name"=> "Vista mare",
                "description" => "L'appartamento ha vista mare."
            ],
            [
                "name"=> "Sauna",
                "description" => "Sauna disponibile nella struttura."
            ],
            [
                "name"=> "Wi-fi",
                "description" => "Connessione wi-fi libera e veloce."
            ],
            [
                "name"=> "Parcheggio privato",
                "description" => "Parcheggio privato e gratuito riservato agli ospiti."
            ],
            [
                "name"=> "Animali consentiti",
                "description" => "E' consentito portare animali nell'appartamento"
            ],
            [
                "name"=> "Frigobar",
                "description" => "Frigobar funzionante disponibile."
            ],
            [
                "name"=> "Culla",
                "description" => "Disponibile nell'appartamento una solida culla per bambini."
            ],
        ];
        foreach ($services as $service) {
            // Instance a new line
            $newService = new AdditionalService();
            // Fill the line
            $newService->fill($service);
            // Save the line
            $newService->save();
        }
    }
}