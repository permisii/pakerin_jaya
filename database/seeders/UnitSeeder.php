<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $units = [
            [
                'name' => 'General Support',
                'unit_code' => 'GS',
            ],
            [
                'name' => 'Unit Produksi 1/2',
                'unit_code' => 'UP1/2',
            ], [
                'name' => 'Unit Produksi 3',
                'unit_code' => 'UP3',
            ], [
                'name' => 'Unit Cogen/Soda',
                'unit_code' => 'UC/S',
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }

    public static function addHeadOfUnitIdForEachOfUnits() {
        $units = Unit::all();

        foreach ($units as $unit) {
            $unit->head_of_unit_id = User::inRandomOrder()->first()->id;
            $unit->save();
        }
    }
}
