<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:touch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Touch database.sqlite';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        File::put(database_path('database.sqlite'),'');
        $this->line('database.sqlite created successfully.');
    }
}
