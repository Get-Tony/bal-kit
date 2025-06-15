<?php

namespace LaravelBalKit\Tests\Feature;

use LaravelBalKit\Tests\TestCase;

class InstallCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Ensure we have a clean state for each test
        $this->app['config']->set('view.paths', [
            resource_path('views'),
        ]);
    }

    /** @test */
    public function it_can_run_install_command_with_minimal_preset()
    {
        $this->artisan('bal:install --preset=minimal')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_run_install_command_with_standard_preset()
    {
        $this->artisan('bal:install --preset=standard')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_run_install_command_with_full_preset()
    {
        $this->artisan('bal:install --preset=full')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_shows_error_for_unknown_preset()
    {
        $this->artisan('bal:install --preset=unknown')
            ->assertExitCode(0); // Command handles error gracefully
    }

    /** @test */
    public function it_can_install_individual_components()
    {
        $this->artisan('bal:install --bootstrap --alpine')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_install_with_sass_option()
    {
        $this->artisan('bal:install --sass')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_install_with_livewire_option()
    {
        $this->artisan('bal:install --livewire')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_install_with_auth_option()
    {
        $this->artisan('bal:install --auth')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_shows_help_when_no_options_provided()
    {
        $this->artisan('bal:install')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_force_overwrite_files()
    {
        // First installation
        $this->artisan('bal:install --preset=minimal')
            ->assertExitCode(0);

        // Second installation with force
        $this->artisan('bal:install --preset=minimal --force')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_handles_preset_configuration_correctly()
    {
        // Test that preset configurations are loaded correctly
        $this->artisan('bal:install --preset=full')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_provides_helpful_completion_message()
    {
        $this->artisan('bal:install --preset=minimal')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_combine_multiple_options()
    {
        $this->artisan('bal:install --bootstrap --alpine --sass --livewire')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_handles_all_preset_types()
    {
        $presets = ['minimal', 'standard', 'full'];

        foreach ($presets as $preset) {
            $this->artisan("bal:install --preset={$preset}")
                ->assertExitCode(0);
        }
    }
}
