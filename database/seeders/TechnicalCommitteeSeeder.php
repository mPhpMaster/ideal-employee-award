<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TechnicalCommittee;

class TechnicalCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TechnicalCommittee::factory()
            ->count(5)
            ->create();
    }
}
