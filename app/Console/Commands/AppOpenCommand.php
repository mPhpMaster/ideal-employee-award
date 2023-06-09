<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 *
 */
class AppOpenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open App in browser.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setAliases([
                              'open',
                              'o',
                          ]);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment("Open: " . url('/'));
        @exec("xdg-open " . url('/') . " | open " . url('/') . " | start " . url('/'));

        return Command::SUCCESS;
    }
}
