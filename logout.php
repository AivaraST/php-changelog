<?php
require __DIR__ . '/bootstrap.php';

use App\Auth;

$auth = new Auth();
$auth->logout();
