<?php

namespace Sparors\Stubs;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class StubsPublishCommand extends Command
{
    protected $signature = 'stub:sparors {--force : Overwrite any existing files}';

    protected $description = 'Publish all Sparors stubs that are available for customization';

    public function handle()
    {
        if (! is_dir($stubsPath = $this->laravel->basePath('stubs'))) {
            (new Filesystem)->makeDirectory($stubsPath);
        }

        collect(File::files(__DIR__ . '/../stubs'))->each(function (SplFileInfo $file) use ($stubsPath) {
            if (! file_exists($targetPath = "{$stubsPath}/{$file->getFilename()}") || $this->option('force')) {
                file_put_contents($targetPath, file_get_contents($file->getPathname()));
            }
        });

        $this->info('Stubs published successfully.');
        
        return 0;
    }
}
