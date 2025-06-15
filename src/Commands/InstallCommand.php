<?php

namespace LaravelBalKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bal:install
                            {--bootstrap : Install Bootstrap CSS framework}
                            {--alpine : Install Alpine.js}
                            {--livewire : Install Livewire}
                            {--sass : Setup SASS with 7-1 architecture}
                            {--auth : Install authentication scaffolding}
                            {--preset= : Use a preset configuration (minimal|standard|full)}
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install BAL Kit (Bootstrap + Alpine + Livewire) components';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Installing BAL Kit for Laravel...');
        $this->newLine();

        // Handle preset
        if ($preset = $this->option('preset')) {
            $this->handlePreset($preset);
            return 0;
        }

        // Handle individual components
        $components = $this->getComponentsToInstall();

        if (empty($components)) {
            $this->info('💡 No components specified. Use --bootstrap, --alpine, --livewire, --sass, or --auth');
            $this->info('   Or use a preset: --preset=minimal|standard|full');
            return 0;
        }

        $this->installComponents($components);

        $this->displayCompletionMessage();

        return 0;
    }

    /**
     * Handle preset installation.
     */
    protected function handlePreset(string $preset): void
    {
        $presets = config('bal-kit.presets', []);

        if (!isset($presets[$preset])) {
            $this->error("❌ Unknown preset: {$preset}");
            $this->info('Available presets: ' . implode(', ', array_keys($presets)));
            return;
        }

        $this->info("📦 Installing '{$preset}' preset...");
        $this->newLine();

        $this->installComponents($presets[$preset]);
    }

    /**
     * Get components to install based on options.
     */
    protected function getComponentsToInstall(): array
    {
        $components = [];

        if ($this->option('bootstrap')) {
            $components['bootstrap'] = true;
        }

        if ($this->option('alpine')) {
            $components['alpine'] = true;
        }

        if ($this->option('livewire')) {
            $components['livewire'] = true;
        }

        if ($this->option('sass')) {
            $components['sass'] = true;
        }

        if ($this->option('auth')) {
            $components['auth'] = true;
        }

        return $components;
    }

    /**
     * Install the specified components.
     */
    protected function installComponents(array $components): void
    {
        if ($components['bootstrap'] ?? false) {
            $this->installBootstrap();
        }

        if ($components['alpine'] ?? false) {
            $this->installAlpine();
        }

        if ($components['livewire'] ?? false) {
            $this->installLivewire();
        }

        if ($components['sass'] ?? false) {
            $this->installSass();
        }

        if ($components['auth'] ?? false) {
            $this->installAuth();
        }

        $this->updatePackageJson();
        $this->updateViteConfig();
        $this->createAppLayout();
    }

    /**
     * Install Bootstrap.
     */
    protected function installBootstrap(): void
    {
        $this->info('📦 Installing Bootstrap...');

        $this->runProcess('npm install bootstrap @popperjs/core');

        $this->info('✅ Bootstrap installed');
    }

    /**
     * Install Alpine.js.
     */
    protected function installAlpine(): void
    {
        $this->info('🏔️ Installing Alpine.js...');

        $this->runProcess('npm install alpinejs');

        $this->info('✅ Alpine.js installed');
    }

    /**
     * Install Livewire.
     */
    protected function installLivewire(): void
    {
        $this->info('⚡ Installing Livewire...');

        // Check if Livewire is already installed
        if ($this->files->exists(base_path('composer.json'))) {
            $composerJson = json_decode($this->files->get(base_path('composer.json')), true);
            $hasLivewire = isset($composerJson['require']['livewire/livewire']);

            if (!$hasLivewire) {
                $this->info('📦 Installing Livewire package...');
                $this->runProcess('composer require livewire/livewire');

                // Clear and rediscover commands to make livewire commands available
                $this->info('🔄 Refreshing Laravel command cache...');
                $this->call('config:clear');
                $this->call('package:discover');

                // Give Laravel a moment to register the new commands
                sleep(1);
            } else {
                $this->info('✅ Livewire already installed');
            }
        } else {
            // Fallback if composer.json doesn't exist
            $this->runProcess('composer require livewire/livewire');
            $this->info('🔄 Refreshing Laravel command cache...');
            $this->call('config:clear');
            $this->call('package:discover');

            // Give Laravel a moment to register the new commands
            sleep(1);
        }

        // Now publish Livewire config if needed
        try {
            // Check if livewire commands are available
            $availableCommands = array_keys($this->getApplication()->all());
            $livewireCommands = array_filter($availableCommands, function($cmd) {
                return strpos($cmd, 'livewire:') === 0;
            });

            if (count($livewireCommands) > 0) {
                $this->info('📋 Publishing Livewire configuration...');
                $this->call('livewire:publish', ['--config' => true]);
            } else {
                $this->warn('⚠️  Livewire commands not yet available. You can publish config manually:');
                $this->line('  php artisan livewire:publish --config');
            }
        } catch (\Exception $e) {
            $this->warn('⚠️  Could not publish Livewire config. You can run it manually:');
            $this->line('  php artisan livewire:publish --config');
        }

        $this->info('✅ Livewire installed');
    }

    /**
     * Install SASS with 7-1 architecture.
     */
    protected function installSass(): void
    {
        $this->info('🎨 Setting up SASS with 7-1 architecture...');

        $this->runProcess('npm install --save-dev sass');

        // Create SASS directory structure
        $sassPath = resource_path('sass');
        $directories = config('bal-kit.sass.directories', [
            'abstracts', 'base', 'components', 'layout', 'pages', 'themes', 'vendors'
        ]);

        foreach ($directories as $dir) {
            $this->files->ensureDirectoryExists("{$sassPath}/{$dir}");
        }

        // Copy SASS stubs
        $this->copyStubs('sass', $sassPath);

        $this->info('✅ SASS configured with 7-1 architecture');
    }

    /**
     * Install authentication scaffolding.
     */
    protected function installAuth(): void
    {
        $this->info('🔐 Installing authentication scaffolding...');

        // Check if user wants Breeze or simple auth
        $useBreeze = $this->confirm('Use Laravel Breeze for authentication?', false);

        if ($useBreeze) {
            $this->installBreezeAuth();
        } else {
            $this->installSimpleAuth();
        }

        $this->info('✅ Authentication scaffolding installed');
    }

    /**
     * Install Breeze-based authentication.
     */
    protected function installBreezeAuth(): void
    {
        // Check if Breeze is already installed
        if ($this->files->exists(base_path('composer.json'))) {
            $composerJson = json_decode($this->files->get(base_path('composer.json')), true);
            $hasBreeze = isset($composerJson['require-dev']['laravel/breeze']) ||
                        isset($composerJson['require']['laravel/breeze']);

            if (!$hasBreeze) {
                $this->info('📦 Installing Laravel Breeze...');
                $this->runProcess('composer require laravel/breeze --dev');
            } else {
                $this->info('✅ Laravel Breeze already installed');
            }
        }

        // Clear and rediscover commands to make breeze:install available
        $this->call('config:clear');
        $this->call('package:discover');

        // Install Breeze with Blade (we'll modify for Bootstrap)
        try {
            $this->info('🎨 Setting up Breeze authentication...');
            $this->call('breeze:install', ['stack' => 'blade', '--no-interaction' => true]);

            $this->info('🔄 Replacing Tailwind with Bootstrap...');
            // Remove Tailwind and install Bootstrap
            $this->runProcess('npm uninstall tailwindcss postcss autoprefixer @tailwindcss/forms');
            $this->runProcess('npm install bootstrap @popperjs/core alpinejs');

            $this->info('✅ Breeze configured with Bootstrap successfully');
        } catch (\Exception $e) {
            $this->warn('⚠️  Breeze installation encountered an issue.');
            $this->warn('You can run it manually after installation:');
            $this->line('  php artisan breeze:install blade');
            $this->line('  npm uninstall tailwindcss postcss autoprefixer');
            $this->line('  npm install bootstrap @popperjs/core alpinejs');
        }
    }

    /**
     * Install simple Bootstrap authentication.
     */
    protected function installSimpleAuth(): void
    {
        // Create auth-related views with Bootstrap styling
        $this->copyStub('auth/login.blade.php', resource_path('views/auth/login.blade.php'));
        $this->copyStub('auth/register.blade.php', resource_path('views/auth/register.blade.php'));

        // Add auth routes to web.php
        $this->addAuthRoutes();
    }

    /**
     * Add authentication routes to web.php
     */
    protected function addAuthRoutes(): void
    {
        $routesPath = base_path('routes/web.php');

        if (!$this->files->exists($routesPath)) {
            return;
        }

        $routes = "
// Basic Authentication Routes Template
// For full authentication, we recommend using Laravel Breeze:
//   composer require laravel/breeze --dev
//   php artisan breeze:install blade
//
// Or add custom authentication routes here:
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);
";

        $this->files->append($routesPath, $routes);

        $this->info('💡 Authentication routes template added to routes/web.php');
        $this->info('📖 For full authentication, install Laravel Breeze:');
        $this->line('   composer require laravel/breeze --dev');
        $this->line('   php artisan breeze:install blade');
    }

    /**
     * Update package.json with BAL Kit scripts.
     */
    protected function updatePackageJson(): void
    {
        $packageJsonPath = base_path('package.json');

        if (!$this->files->exists($packageJsonPath)) {
            return;
        }

        $packageJson = json_decode($this->files->get($packageJsonPath), true);

        // Add/update scripts
        $packageJson['scripts'] = array_merge($packageJson['scripts'] ?? [], [
            'bal:dev' => 'vite',
            'bal:build' => 'vite build',
            'bal:preview' => 'vite preview',
        ]);

        $this->files->put(
            $packageJsonPath,
            json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        $this->info('📄 Updated package.json');
    }

    /**
     * Update Vite configuration.
     */
    protected function updateViteConfig(): void
    {
        $viteConfigPath = base_path('vite.config.js');

        if ($this->files->exists($viteConfigPath)) {
            $this->copyStub('vite.config.js', $viteConfigPath);
            $this->info('⚡ Updated Vite configuration');
        }
    }

    /**
     * Create the main application layout.
     */
    protected function createAppLayout(): void
    {
        $layoutPath = resource_path('views/layouts/app.blade.php');

        if (!$this->files->exists($layoutPath) || $this->option('force')) {
            $this->copyStub('layouts/app.blade.php', $layoutPath);
            $this->info('🎨 Created application layout');
        }
    }

    /**
     * Copy stub files to destination.
     */
    protected function copyStubs(string $stubDir, string $destination): void
    {
        $stubPath = __DIR__ . "/../Stubs/{$stubDir}";

        if (!$this->files->isDirectory($stubPath)) {
            return;
        }

        $files = $this->files->allFiles($stubPath);

        foreach ($files as $file) {
            $relativePath = $file->getRelativePathname();
            $destinationPath = "{$destination}/{$relativePath}";

            $this->files->ensureDirectoryExists(dirname($destinationPath));
            $this->files->copy($file->getPathname(), $destinationPath);
        }
    }

    /**
     * Copy a single stub file.
     */
    protected function copyStub(string $stub, string $destination): void
    {
        $stubPath = __DIR__ . "/../Stubs/{$stub}";

        if ($this->files->exists($stubPath)) {
            $this->files->ensureDirectoryExists(dirname($destination));
            $this->files->copy($stubPath, $destination);
        }
    }

    /**
     * Run a shell process.
     */
    protected function runProcess(string $command): void
    {
        $process = Process::fromShellCommandline($command, base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            $this->warn("Command failed: {$command}");
        }
    }

    /**
     * Display completion message.
     */
    protected function displayCompletionMessage(): void
    {
        $this->newLine();
        $this->info('🎉 BAL Kit installation completed!');
        $this->newLine();

        $this->comment('Next steps:');
        $this->line('  1. Run: npm install && npm run bal:build');
        $this->line('  2. Visit your application in the browser');
        $this->line('  3. Start building with Bootstrap + Alpine + Livewire!');
        $this->newLine();

        $this->comment('Available commands:');
        $this->line('  php artisan bal:publish    # Publish additional stubs');
        $this->line('  npm run bal:dev           # Start development server');
        $this->line('  npm run bal:build         # Build for production');
    }
}
