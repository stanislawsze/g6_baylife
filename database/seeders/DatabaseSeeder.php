<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DiscordRole;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tableVeh = [
            ['name' => 'Stockade', 'plate' => 'G6 BRA', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 CHA', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 DEL', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 ECH', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 FOX', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 GOL', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 HOT', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 IND', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 JUL', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 KIL', 'image' => 'img/vehicle/stockade.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'R6 ALP', 'image' => 'img/vehicle/nightshark.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'R6 BRA', 'image' => 'img/vehicle/nightshark.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'R6 CHA', 'image' => 'img/vehicle/nightshark.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'VGS 539', 'image' => 'img/vehicle/nightshark.jpg', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'AUB 559', 'image' => 'img/vehicle/u2r.png', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'BSB 198', 'image' => 'img/vehicle/u2r.png', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'EKQ 323', 'image' => 'img/vehicle/u2r.png', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'OUU 454', 'image' => 'img/vehicle/u2r.png', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'RIW 719', 'image' => 'img/vehicle/u2r.png', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
        ];
        foreach($tableVeh as $t)
        {
            Vehicle::create($t);
        }
    }
}
