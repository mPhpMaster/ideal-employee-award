<?php

namespace App\Console\Commands;

use App\Interfaces\IRole;
use Illuminate\Console\Command;

/**
 *
 */
class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate admin user.';

    protected static array $admin_data = [
        'name' => 'Administrator',
        'email' => 'admin@app.com',
        'password' => 'Admin@123',
        'role' => IRole::SuperAdminRole,
        'phone' => '0537581003',
        'remember_token' => 'sfdsggbesr',
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Adding an admin user
        $user = \App\Models\User::firstOrCreate(...array_only_except(static::$admin_data, [ 'email' ]));
        $user->markEmailAsVerified();
        $user->assignRole(IRole::SuperAdminRole);

        $columns = array_keys(static::$admin_data);
        $this->table($columns, [ $user->only($columns) ]);

        $this->info("Done!");

        return Command::SUCCESS;
    }
}
