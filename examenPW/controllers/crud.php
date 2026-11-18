<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/database.php';
require_login();
require dirname(__DIR__) . '/includes/modules.php';
require dirname(__DIR__) . '/includes/crud.php';

if (!isset($module, $modules[$module])) {
    http_response_code(400);
    exit('Módulo no válido.');
}

$definition = $modules[$module];
$page = basename($_SERVER['SCRIPT_NAME']);
$basePath = '..';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = processCrudRequest($pdo, $module, $definition);
    if (!$error) {
        header("Location: {$page}");
        exit;
    }
}

$rows = fetchCrudRows($pdo, $definition);
$editing = fetchCrudEditing($pdo, $definition, isset($_GET['edit']) ? (int) $_GET['edit'] : null);
$pageTitle = $definition['title'];

require dirname(__DIR__) . '/includes/header.php';
require dirname(__DIR__) . '/views/crud.php';
require dirname(__DIR__) . '/includes/footer.php';
