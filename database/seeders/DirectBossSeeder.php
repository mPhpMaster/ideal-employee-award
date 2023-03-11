<?php

namespace Database\Seeders;

use App\Models\DirectBoss;
use Illuminate\Database\Seeder;

class DirectBossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DirectBoss::factory()
            ->count(5)
            ->create();
    }
}
