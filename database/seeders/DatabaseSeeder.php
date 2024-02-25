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
            ['name' => 'Stockade', 'plate' => 'G6 BRA', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 CHA', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 DEL', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 ECH', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 FOX', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 GOL', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 HOT', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 IND', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 JUL', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Stockade', 'plate' => 'G6 KIL', 'image' => 'stockade', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'R6 ALP', 'image' => 'nightshark', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'R6 BRA', 'image' => 'nightshark', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'R6 CHA', 'image' => 'nightshark', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Nightshark', 'plate' => 'VGS 539', 'image' => 'nightshark', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'AUB 559', 'image' => 'u2r', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'BSB 198', 'image' => 'u2r', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'EKQ 323', 'image' => 'u2r', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'OUU 454', 'image' => 'u2r', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
            ['name' => 'Moto Police', 'plate' => 'RIW 719', 'image' => 'u2r', 'in_use' => false, 'is_maintained' => false, 'is_refuel' => false, 'is_usable_for_convoy' => true],
        ];
        foreach($tableVeh as $t)
        {
            Vehicle::create($t);
        }
    }
}
