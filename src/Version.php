<?php

namespace LaravelBalKit;

/**
 * BAL Kit Version Management
 *
 * Centralized version information for the entire package.
 * This is the single source of truth for version numbers.
 */
class Version
{
    /**
     * The current version of BAL Kit.
     */
    public const VERSION = '1.5.2';

    /**
     * The version constraint for Composer installations.
     */
    public const CONSTRAINT = '^1.5.2';

    /**
     * The release date of the current version.
     */
    public const RELEASE_DATE = '2025-01-27';

    /**
     * The version name/codename.
     */
    public const CODENAME = 'Breeze Integration Fix';

    /**
     * Get the current version.
     */
    public static function current(): string
    {
        return self::VERSION;
    }

    /**
     * Get the version constraint for Composer.
     */
    public static function constraint(): string
    {
        return self::CONSTRAINT;
    }

    /**
     * Get the release date.
     */
    public static function releaseDate(): string
    {
        return self::RELEASE_DATE;
    }

    /**
     * Get the version codename.
     */
    public static function codename(): string
    {
        return self::CODENAME;
    }

    /**
     * Get the full version string with codename.
     */
    public static function full(): string
    {
        return self::VERSION.' - '.self::CODENAME;
    }

    /**
     * Get version information as an array.
     */
    public static function info(): array
    {
        return [
            'version' => self::VERSION,
            'constraint' => self::CONSTRAINT,
            'release_date' => self::RELEASE_DATE,
            'codename' => self::CODENAME,
            'full' => self::full(),
        ];
    }

    /**
     * Check if a given version is compatible.
     */
    public static function isCompatible(string $version): bool
    {
        return version_compare($version, '1.0.0', '>=');
    }

    /**
     * Get the GitHub release URL for the current version.
     */
    public static function releaseUrl(): string
    {
        return 'https://github.com/get-tony/bal-kit/releases/tag/v'.self::VERSION;
    }

    /**
     * Get the Packagist URL.
     */
    public static function packagistUrl(): string
    {
        return 'https://packagist.org/packages/get-tony/bal-kit';
    }
}
