<?php

use App\Sponsor;
use Illuminate\Database\Seeder;

class SponsorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'name' => 'Base',
                'price' => 2.99,
                'duration' => 24
            ],
            [
                'name' => 'Standard',
                'price' => 5.99,
                'duration' => 72
            ],
            [
                'name' => 'Premium',
                'price' => 9.99,
                'duration' => 144
            ]
        ];
        foreach ($sponsors as $sponsor) {
            // Instance a new line
            $newSponsor = new Sponsor();
            // Fill the line
            $newSponsor->fill($sponsor);
            // Save the line
            $newSponsor->save();
        }
    }
}
