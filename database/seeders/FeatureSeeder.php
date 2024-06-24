<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            "أكبر مسبح مكشوف علي مستوي المملكة",
            "مسبح اولومبي 50م &25م العمق",
            "مدربين محترفين علي مستوي المملكة",
        ];

        foreach ($features as $feature) {

            Feature::create([
                'name' => $feature,
                'status' => 'active'
            ]);
        }
    }
}
