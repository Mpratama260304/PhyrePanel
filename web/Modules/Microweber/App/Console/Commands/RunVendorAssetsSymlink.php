<?php

namespace Modules\Microweber\App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Microweber\Jobs\RunInstallationCommands;

class RunVendorAssetsSymlink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'microweber:run-vendor-assets-symlink {--installation-id= : Run for a specific installation ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run microweber:vendor-assets-symlink command for all Microweber installations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $installationId = $this->option('installation-id');

        if ($installationId) {
            $this->info('Running microweber:vendor-assets-symlink for installation ID: ' . $installationId);
        } else {
            $this->info('Running microweber:vendor-assets-symlink for all installations...');
        }

        $job = new RunInstallationCommands(
            'microweber:vendor-assets-symlink',
            $installationId ? (int)$installationId : null
        );

        $job->handle();

        $this->info('Command executed successfully!');
    }
}

