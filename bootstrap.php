<?php

use Dotenv\Dotenv;

/**
 * Add autoload in project
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Start session for auth
 */
session_start();

/**
 * Load dotenv in project
 */
$dotenv = Dotenv::createImmutable(__DIR__)->load();
