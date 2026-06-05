<?php
require_once __DIR__ . '/../includes/db.php';

use App\Auth;

Auth::logout();
header('Location: login.php');
exit;
