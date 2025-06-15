<?php

namespace LaravelBalKit\Tests;

use LaravelBalKit\BalKitServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Additional setup can go here
    }

    /**
     * Get package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            BalKitServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     */
    protected function getEnvironmentSetUp($app): void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Setup application key for encryption
        $app['config']->set('app.key', 'base64:2fl+Ktvkfl+Fuz4Qp/A75G2RTiWVA/ZoKZvp6fiiM10=');

        // Setup view paths
        $app['config']->set('view.paths', [
            __DIR__.'/../src/Stubs/layouts',
            __DIR__.'/../src/Stubs/auth',
            __DIR__.'/../src/Stubs/pages',
            resource_path('views'),
        ]);
    }

    /**
     * Define package aliases.
     */
    protected function getPackageAliases($app): array
    {
        return [
            // Add any package aliases here
        ];
    }

    /**
     * Helper method to create a temporary Laravel app for testing installations.
     */
    protected function createTempApp(): string
    {
        $tempDir = sys_get_temp_dir().'/bal-kit-test-'.uniqid();
        mkdir($tempDir, 0755, true);

        // Create basic Laravel structure
        mkdir($tempDir.'/app', 0755, true);
        mkdir($tempDir.'/config', 0755, true);
        mkdir($tempDir.'/resources/views', 0755, true);
        mkdir($tempDir.'/resources/sass', 0755, true);
        mkdir($tempDir.'/resources/js', 0755, true);
        mkdir($tempDir.'/public', 0755, true);

        return $tempDir;
    }

    /**
     * Clean up temporary directories.
     */
    protected function cleanupTempApp(string $path): void
    {
        if (is_dir($path)) {
            $this->deleteDirectory($path);
        }
    }

    /**
     * Recursively delete a directory.
     */
    private function deleteDirectory(string $dir): void
    {
        if (! is_dir($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir.'/'.$file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        rmdir($dir);
    }
}
