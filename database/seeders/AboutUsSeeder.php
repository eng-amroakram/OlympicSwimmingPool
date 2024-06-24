<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'title' => "حولنا",
            'features' => json_encode([1, 2, 3]),
            'video_link' => "https://www.youtube.com/watch?v=9xBzzz1Zsmw",
            'status' => "active",
        ]);
    }
}
