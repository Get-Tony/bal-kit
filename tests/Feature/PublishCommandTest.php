<?php

namespace LaravelBalKit\Tests\Feature;

use LaravelBalKit\Tests\TestCase;

class PublishCommandTest extends TestCase
{
    /** @test */
    public function it_can_run_publish_command_with_config_option()
    {
        $this->artisan('bal:publish --config')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_can_run_publish_command_with_stubs_option()
    {
        $this->artisan('bal:publish --stubs')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_can_run_publish_command_with_components_option()
    {
        $this->artisan('bal:publish --components')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_can_run_publish_command_with_all_option()
    {
        $this->artisan('bal:publish --all')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_can_list_available_vendor_publish_tags()
    {
        $this->artisan('bal:publish --list')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_shows_help_when_no_options_provided()
    {
        $this->artisan('bal:publish')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_can_force_overwrite_published_files()
    {
        // First publish
        $this->artisan('bal:publish --config')
             ->assertExitCode(0);

        // Second publish with force
        $this->artisan('bal:publish --config --force')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_can_publish_multiple_options_together()
    {
        $this->artisan('bal:publish --config --stubs')
             ->assertExitCode(0);
    }

    /** @test */
    public function vendor_publish_works_with_bal_kit_tags()
    {
        // Test that Laravel's vendor:publish command works with our tags
        $this->artisan('vendor:publish --tag=bal-kit-config')
             ->assertExitCode(0);
    }

    /** @test */
    public function vendor_publish_works_with_provider()
    {
        // Test that Laravel's vendor:publish command works with our provider
        $this->artisan('vendor:publish --provider=LaravelBalKit\BalKitServiceProvider')
             ->assertExitCode(0);
    }

    /** @test */
    public function it_handles_individual_tag_publishing()
    {
        // Test individual tags
        $tags = [
            'bal-kit-sass',
            'bal-kit-js',
            'bal-kit-layouts',
            'bal-kit-components',
            'bal-kit-auth',
            'bal-kit-pages',
            'bal-kit-vite',
        ];

        foreach ($tags as $tag) {
            $this->artisan("vendor:publish --tag={$tag}")
                 ->assertExitCode(0);
        }
    }

    /** @test */
    public function it_can_publish_all_available_options()
    {
        $options = ['config', 'stubs', 'components'];

        foreach ($options as $option) {
            $this->artisan("bal:publish --{$option}")
                 ->assertExitCode(0);
        }
    }

    /** @test */
    public function it_handles_force_option_correctly()
    {
        // Test force option with different combinations
        $this->artisan('bal:publish --all --force')
             ->assertExitCode(0);

        $this->artisan('bal:publish --config --stubs --force')
             ->assertExitCode(0);
    }
}
