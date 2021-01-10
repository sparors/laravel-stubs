<?php

namespace Sparors\Stubs\Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;
use Sparors\Stubs\StubsServiceProvider;
use Symfony\Component\Finder\SplFileInfo;

class StubPublishCommandTest extends TestCase
{
    /**
     * @dataProvider filenames
     */
    public function testItPublishStubs($filename)
    {
        $target = $this->app->basePath('stubs');

        File::deleteDirectory($target);

        $this->artisan('stub:sparors')->assertExitCode(0);

        $this->assertFileEquals(__DIR__ . "/../stubs/{$filename}", "{$target}/{$filename}");
    }

    public function filenames()
    {
        // return collect(File::files(__DIR__ . '/../stubs'))->map(function (SplFileInfo $file) {
        //     return $file->getFilename();
        // })->toArray();
        return [
            ["cast.stub",],
            ["console.stub",],
            ["controller.api.stub",],
            ["controller.invokable.stub",],
            ["controller.model.api.stub",],
            ["controller.model.stub",],
            ["controller.nested.api.stub",],
            ["controller.nested.stub",],
            ["controller.plain.stub",],
            ["controller.stub",],
            ["factory.stub",],
            ["job.queued.stub",],
            ["job.stub",],
            ["middleware.stub",],
            ["migration.create.stub",],
            ["migration.stub",],
            ["migration.update.stub",],
            ["model.pivot.stub",],
            ["model.stub",],
            ["observer.plain.stub",],
            ["observer.stub",],
            ["policy.plain.stub",],
            ["policy.stub",],
            ["request.stub",],
            ["resource-collection.stub",],
            ["resource.stub",],
            ["rule.stub",],
            ["seeder.stub",],
            ["test.stub",],
            ["test.unit.stub",],
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            StubsServiceProvider::class,
        ];
    }
}
