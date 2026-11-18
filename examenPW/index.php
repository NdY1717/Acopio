<?php
declare(strict_types=1);
require_once __DIR__ . '/config/database.php';

if (($_GET['action'] ?? '') === 'logout') {
    session_destroy();
    header('Location: auth/login.php');
    exit;
}

if (empty($_SESSION['usuario'])) {
    header('Location: auth/login.php');
    exit;
}

require __DIR__ . '/controllers/dashboard.php';
