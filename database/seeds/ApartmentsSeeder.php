<?php

use App\Apartment;
use Illuminate\Database\Seeder;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = [
            [
                'title' => 'Casa In Centro Milano Vista Duomo',
                'rooms_number' => 6,
                'beds_number' => 4,
                'baths_number' => 2,
                'guests' => 5,
                'squaremeters' => 132,
                'longitude' => '44.424482',
                'latitude' => '8.876339',
                'visible' => true,
                'slug' => 'casa-in-centro-milano-vista-duomo',
                'photo' => 'https://living.corriere.it/wp-content/uploads/2015/04/suiteVelasca03_MGbig.jpg',
                'address' => 'Via Roma 25A/4',
                'user_id' => 1, 
            ],
            [
                'title' => 'Casa In Periferia Milano Ben Arredata',
                'rooms_number' => 4,
                'beds_number' => 2,
                'baths_number' => 1,
                'guests' => 3,
                'squaremeters' => 100,
                'longitude' => '54.364482',
                'latitude' => '6.356339',
                'visible' => true,
                'slug' => 'casa-in-periferia-milano-ben-arredata',
                'photo' => 'https://pic.trovacasa.net/image/1163902828/xxs-c.jpg',
                'address' => 'Via Brombeis 13B',
                'user_id' => 1, 
            ],
            [
                'title' => 'Casa Perfetta Per La Famiglia',
                'rooms_number' => 2.99,
                'beds_number' => 4,
                'baths_number' => 2,
                'guests' => 5,
                'squaremeters' => 132,
                'longitude' => '44.424482',
                'latitude' => '8.876339',
                'visible' => true,
                'slug' => 'casa-perfetta-per-la-famiglia',
                'photo' => 'https://living.corriere.it/wp-content/uploads/2015/10/01_b_interni-case-milano.jpg',
                'address' => 'Via Chiabrera 42d',
                'user_id' => 1, 
            ],
            [
                'title' => 'Casa Ristrutturata In Centro Milano',
                'rooms_number' => 2.99,
                'beds_number' => 4,
                'baths_number' => 2,
                'guests' => 5,
                'squaremeters' => 132,
                'longitude' => '64.325482',
                'latitude' => '5.423339',
                'visible' => true,
                'slug' => 'casa-ristrutturata-in-centro-milano',
                'photo' => 'https://cdn.dove.it/properties/2069/medium/IMG_4499.jpg',
                'address' => 'Via XVII Settembre 52B/3',
                'user_id' => 1, 
            ],
        ];
        foreach ($apartments as $apartment) {
            // Instance a new line
            $newApartment = new Apartment();
            // Fill the line
            $newApartment->fill($apartment);
            // Save the line
            $newApartment->save();
        }
    }
}
