<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupervisorCommittee;

class SupervisorCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupervisorCommittee::factory()
            ->count(5)
            ->create();
    }
}
