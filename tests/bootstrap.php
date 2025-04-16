<?php

/**
 * phpcs:ignoreFile.
 */

require_once __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;

/**
 * -----------------------------------------------------------------------------
 * Register environment variable loader automatically
 * -----------------------------------------------------------------------------
 * .dotenv provides an easy way to access environment variables with $_ENV
 * -----------------------------------------------------------------------------.
 */
if (file_exists(__DIR__.'/../.env')) {
    Dotenv::createMutable(__DIR__.'/../')->load();
}

/** @var string $path */
$path = $_ENV['PATH'];

define('FOLDER_PATH', $path);
