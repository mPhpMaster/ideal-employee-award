<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

/**
 *
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        Artisan::call("app:admin");

        $this->call(Story1Seeder::class);

        // Adding an admin user
        // $user = \App\Models\User::factory()
        //     ->count(1)
        //     ->create([
        //         'email' => 'admin@admin.com',
        //         'password' => \Hash::make('admin'),
        //     ]);
        // $this->call(PermissionsSeeder::class);
        //
        // $this->call(ApplicationSeeder::class);
        // $this->call(AwardSeeder::class);
        // $this->call(DirectBossSeeder::class);
        // $this->call(EmployeeSeeder::class);
        // $this->call(PositionSeeder::class);
        // $this->call(SupervisorCommitteeSeeder::class);
        // $this->call(TechnicalCommitteeSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
