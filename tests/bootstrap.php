<?php
/**
 * Bootstrap file for running the tests on PHPCS 3.x.
 */

if (!defined('PHP_CODESNIFFER_IN_TESTS')) {
    define('PHP_CODESNIFFER_IN_TESTS', true);
}

// The below two defines are needed for PHPCS 3.x.
if (defined('PHP_CODESNIFFER_CBF') === false) {
    define('PHP_CODESNIFFER_CBF', false);
}

if (defined('PHP_CODESNIFFER_VERBOSITY') === false) {
    define('PHP_CODESNIFFER_VERBOSITY', 0);
}

// Get the PHPCS dir from an environment variable.
$phpcsDir = getenv('PHPCS_DIR')
    ? realpath(getenv('PHPCS_DIR'))
    : dirname(__DIR__) . '/vendor/squizlabs/php_codesniffer';

// Try and load the PHPCS autoloader.
if (is_dir($phpcsDir) && file_exists($phpcsDir . '/autoload.php')) {
    require_once $phpcsDir . '/autoload.php';
} else {
    echo 'Uh oh... can\'t find PHPCS. Are you sure you are using PHPCS 3.x ?

If you use Composer, please run `composer install`.
Otherwise, make sure you set a `PHPCS_DIR` environment variable in your phpunit.xml file
pointing to the PHPCS directory.

Please read the contributors guidelines for more information:
';

    exit(1);
}

unset($phpcsDir);
