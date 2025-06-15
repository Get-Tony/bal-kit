<?php

namespace LaravelBalKit\Tests\Unit;

use LaravelBalKit\Commands\InstallCommand;
use LaravelBalKit\Commands\PublishCommand;
use LaravelBalKit\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_install_command()
    {
        $commands = $this->app['Illuminate\Contracts\Console\Kernel']->all();

        $this->assertArrayHasKey('bal:install', $commands);
        $this->assertInstanceOf(InstallCommand::class, $commands['bal:install']);
    }

    /** @test */
    public function it_registers_publish_command()
    {
        $commands = $this->app['Illuminate\Contracts\Console\Kernel']->all();

        $this->assertArrayHasKey('bal:publish', $commands);
        $this->assertInstanceOf(PublishCommand::class, $commands['bal:publish']);
    }

    /** @test */
    public function it_merges_configuration()
    {
        $config = $this->app['config']->get('bal-kit');

        $this->assertIsArray($config);
        $this->assertArrayHasKey('presets', $config);
        $this->assertArrayHasKey('minimal', $config['presets']);
        $this->assertArrayHasKey('standard', $config['presets']);
        $this->assertArrayHasKey('full', $config['presets']);
    }

    /** @test */
    public function it_has_correct_preset_configurations()
    {
        $config = $this->app['config']->get('bal-kit.presets');

        // Test minimal preset
        $this->assertArrayHasKey('minimal', $config);
        $this->assertTrue($config['minimal']['bootstrap']);
        $this->assertTrue($config['minimal']['alpine']);
        $this->assertFalse($config['minimal']['livewire']);
        $this->assertFalse($config['minimal']['auth']);

        // Test standard preset
        $this->assertArrayHasKey('standard', $config);
        $this->assertTrue($config['standard']['bootstrap']);
        $this->assertTrue($config['standard']['alpine']);
        $this->assertTrue($config['standard']['livewire']);
        $this->assertTrue($config['standard']['sass']);
        $this->assertFalse($config['standard']['auth']);

        // Test full preset
        $this->assertArrayHasKey('full', $config);
        $this->assertTrue($config['full']['bootstrap']);
        $this->assertTrue($config['full']['alpine']);
        $this->assertTrue($config['full']['livewire']);
        $this->assertTrue($config['full']['sass']);
        $this->assertTrue($config['full']['auth']);
    }

    /** @test */
    public function it_registers_service_provider()
    {
        // Test that the service provider is loaded
        $providers = $this->app->getLoadedProviders();
        $this->assertArrayHasKey('LaravelBalKit\BalKitServiceProvider', $providers);
    }

    /** @test */
    public function it_has_correct_package_namespace()
    {
        $reflection = new \ReflectionClass('LaravelBalKit\BalKitServiceProvider');
        $this->assertEquals('LaravelBalKit', $reflection->getNamespaceName());
    }

    /** @test */
    public function it_can_resolve_commands_from_container()
    {
        // Test that we can resolve the command classes
        $installCommand = $this->app->make(InstallCommand::class);
        $publishCommand = $this->app->make(PublishCommand::class);

        $this->assertInstanceOf(InstallCommand::class, $installCommand);
        $this->assertInstanceOf(PublishCommand::class, $publishCommand);
    }
}
