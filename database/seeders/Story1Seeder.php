<?php

namespace Database\Seeders;

use App\Interfaces\IRole;
// use App\Models\Material;
// use App\Models\Payment;
// use App\Models\Permission;
// use App\Models\Project;
// use App\Models\Report;
// use App\Models\Role;
// use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 *
 */
class Story1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(\InConfigParser::userOf([
                                                            'email' => 'ahmad@gmail.com',
                                                            'name' => 'ahmad supervisor',
                                                            'role' => IRole::SupervisorRole,
                                                            'password' => bcrypt('12341234'),
                                                        ]));

        // User::factory()
        //     ->count(5)
        //     ->has(
        //         Project::factory(2)
        //                ->has(
        //                    Task::factory(2)
        //                        ->has(Material::factory())
        //                )
        //                ->has(Payment::factory(5))
        //                ->has(Report::factory(1))
        //     )
        //     ->create();
        //
        // User::factory()
        //     ->count(2)
        //     ->has(
        //         Project::factory(1)
        //                ->has(Task::factory(10))
        //                ->has(Material::factory(0))
        //                ->has(Payment::factory(0))
        //                ->has(Report::factory(0))
        //     )
        //     ->create();
        //
        // User::factory()
        //     ->count(3)
        //     ->has(
        //         Project::factory(3)
        //                ->has(Task::factory(40))
        //                ->has(Material::factory(33))
        //                ->has(Payment::factory(0))
        //                ->has(Report::factory(0))
        //     )
        //     ->create();
    }
}
