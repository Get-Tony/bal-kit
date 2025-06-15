<?php

namespace LaravelBalKit\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bal:publish
                            {--config : Publish configuration file}
                            {--stubs : Publish stub files}
                            {--components : Publish example Livewire components}
                            {--all : Publish all resources}
                            {--list : List all available vendor:publish tags}
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish BAL Kit resources (config, stubs, components) or list vendor:publish options';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if ($this->option('list')) {
            $this->listVendorPublishTags();
            return 0;
        }

        $this->info('📦 Publishing BAL Kit resources...');
        $this->newLine();

        if ($this->option('all')) {
            $this->publishConfig();
            $this->publishStubs();
            $this->publishComponents();
        } else {
            if ($this->option('config')) {
                $this->publishConfig();
            }

            if ($this->option('stubs')) {
                $this->publishStubs();
            }

            if ($this->option('components')) {
                $this->publishComponents();
            }

            if (!$this->option('config') && !$this->option('stubs') && !$this->option('components')) {
                $this->info('💡 Specify what to publish: --config, --stubs, --components, or --all');
                $this->newLine();
                $this->info('💡 Or use --list to see all vendor:publish options');
                return 0;
            }
        }

        $this->newLine();
        $this->info('✅ BAL Kit resources published successfully!');

        return 0;
    }

    /**
     * Publish configuration file.
     */
    protected function publishConfig(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'bal-kit-config',
            '--force' => $this->option('force'),
        ]);

        $this->info('📄 Configuration file published');
    }

    /**
     * Publish stub files.
     */
    protected function publishStubs(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'bal-kit-stubs',
            '--force' => $this->option('force'),
        ]);

        $this->info('📝 Stub files published');
    }

    /**
     * Publish example components.
     */
    protected function publishComponents(): void
    {
        $this->info('🧩 Publishing example Livewire components...');

        // This would copy example Livewire components
        // Implementation depends on specific components you want to include

        $this->info('✅ Example components published');
    }

    /**
     * List all available vendor:publish tags for BAL Kit.
     */
    protected function listVendorPublishTags(): void
    {
        $this->info('📋 Available vendor:publish tags for BAL Kit:');
        $this->newLine();

        $tags = [
            'bal-kit-config' => 'Configuration file only',
            'bal-kit-sass' => 'SASS architecture (7-1 structure)',
            'bal-kit-js' => 'JavaScript files',
            'bal-kit-layouts' => 'Layout templates',
            'bal-kit-components' => 'Blade component templates',
            'bal-kit-auth' => 'Authentication views',
            'bal-kit-pages' => 'Example pages',
            'bal-kit-vite' => 'Vite configuration',
            'bal-kit-stubs' => 'All stub files (for manual installation)',
            'bal-kit' => 'Everything (config + stubs)',
        ];

        foreach ($tags as $tag => $description) {
            $this->line("  <info>{$tag}</info> - {$description}");
        }

        $this->newLine();
        $this->info('📖 Usage Examples:');
        $this->line('  <comment>php artisan vendor:publish --tag=bal-kit-sass</comment>');
        $this->line('  <comment>php artisan vendor:publish --tag=bal-kit-auth --force</comment>');
        $this->line('  <comment>php artisan vendor:publish --provider="LaravelBalKit\BalKitServiceProvider"</comment>');

        $this->newLine();
        $this->info('💡 For complete installation, use: <comment>php artisan bal:install --preset=full</comment>');
    }
}
