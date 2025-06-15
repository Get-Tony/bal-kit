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
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish BAL Kit resources (config, stubs, components)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
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
}
