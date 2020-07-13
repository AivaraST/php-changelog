<?php

use Dotenv\Dotenv;

/**
 * Add autoload in project
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Add dotenv in project
 */
$dotenv = Dotenv::createImmutable(__DIR__)->load();


/**
 * Start session for authentication
 */
session_start();
