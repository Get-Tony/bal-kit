#!/usr/bin/env php
<?php

/**
 * BAL Kit Version Helper
 *
 * This script provides version information for shell scripts and CI/CD.
 * Usage: php bin/version.php [option]
 *
 * Options:
 *   version     - Get current version (default)
 *   constraint  - Get Composer constraint
 *   date        - Get release date
 *   codename    - Get version codename
 *   full        - Get full version string
 *   info        - Get all version info as JSON
 */

// Autoload the Version class
require_once __DIR__.'/../../src/Version.php';

use LaravelBalKit\Version;

// Get the requested option
$option = $argv[1] ?? 'version';

switch ($option) {
    case 'version':
        echo Version::current();
        break;

    case 'constraint':
        echo Version::constraint();
        break;

    case 'date':
        echo Version::releaseDate();
        break;

    case 'codename':
        echo Version::codename();
        break;

    case 'full':
        echo Version::full();
        break;

    case 'info':
        echo json_encode(Version::info(), JSON_PRETTY_PRINT);
        break;

    case 'help':
    case '--help':
    case '-h':
        echo "BAL Kit Version Helper\n\n";
        echo "Usage: php bin/version.php [option]\n\n";
        echo "Options:\n";
        echo "  version     - Get current version (default)\n";
        echo "  constraint  - Get Composer constraint\n";
        echo "  date        - Get release date\n";
        echo "  codename    - Get version codename\n";
        echo "  full        - Get full version string\n";
        echo "  info        - Get all version info as JSON\n";
        echo "  help        - Show this help message\n";
        break;

    default:
        echo "Unknown option: $option\n";
        echo "Use 'php bin/version.php help' for available options.\n";
        exit(1);
}

echo "\n";
