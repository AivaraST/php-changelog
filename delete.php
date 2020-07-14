<?php

use App\Admin;

require __DIR__ . '/bootstrap.php';

$admin = new Admin();
$admin->delete($_GET['id']);