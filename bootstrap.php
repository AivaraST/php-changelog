<?php

use Dotenv\Dotenv;

/**
 * Add autoload in project.
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Load dotenv in project.
 */
$dotenv = Dotenv::createImmutable(__DIR__)->load();

/**
 * Load types config in project
 */
require __DIR__ . '/app/configs/types.config.php';
