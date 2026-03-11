<?php

namespace Modules\Microweber\App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Microweber\Jobs\RunInstallationCommands;

class RunInstallationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'microweber:run-command
                            {command : The artisan/composer command to run}
                            {--installation-id= : Run for a specific installation ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run artisan or composer commands for all Microweber installations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $command = $this->argument('command');
        $installationId = $this->option('installation-id');

        if ($installationId) {
            $this->info("Running '{$command}' for installation ID: " . $installationId);
        } else {
            $this->info("Running '{$command}' for all installations...");
        }

        $job = new RunInstallationCommands(
            $command,
            $installationId ? (int)$installationId : null
        );

        $job->handle();

        $this->info('Command executed successfully!');
    }
}

