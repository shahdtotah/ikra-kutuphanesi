<?php

namespace Database\Seeders;

use App\Models\Writers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WritersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Writers::factory()
        ->count(25)
        ->hasBookss(5)
        ->create();
        //
    }
}
