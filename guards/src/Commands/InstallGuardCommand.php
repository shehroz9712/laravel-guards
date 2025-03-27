
<?php

namespace Laravel\Guards\Commands;

use Illuminate\Console\Command;

class InstallGuardCommand extends Command
{
    protected $signature = 'guard:install';

    protected $description = 'Install Laravel Guards Package';

    public function handle()
    {
        $file = base_path('app/Providers/AppServiceProvider.php');

        if (!file_exists($file)) {
            $this->error('AppServiceProvider not found.');
            return;
        }

        $content = file_get_contents($file);

        $guardCheck = "\n        if (file_exists(base_path('.guard.lock'))) {\n            die('Application Locked: License Missing');\n        }\n";

        if (strpos($content, 'Application Locked') === false) {
            $content = str_replace(
                'public function boot()',
                "public function boot() {\n" . $guardCheck,
                $content
            );

            file_put_contents($file, $content);
            $this->info('Guard license lock injected successfully.');
        }

        file_put_contents(base_path('.guard.lock'), 'locked');
        $this->info('.guard.lock file created.');
    }
}
