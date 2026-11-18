<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/database.php';
require_login();
require dirname(__DIR__) . '/includes/modules.php';

$pageTitle = 'Panel principal';
$basePath = '.';
$counts = [];
foreach ($modules as $key => $definition) {
    $counts[$key] = (int) $pdo->query("SELECT COUNT(*) FROM {$definition['table']}")->fetchColumn();
}

require dirname(__DIR__) . '/includes/header.php';
require dirname(__DIR__) . '/views/dashboard.php';
require dirname(__DIR__) . '/includes/footer.php';
