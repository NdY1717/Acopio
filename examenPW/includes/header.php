<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?= e($pageTitle) ?> | Centro de Acopio</title>
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="<?= e($basePath) ?>/index.php">Centro de Acopio</a>
    <span class="text-white"><?= e($_SESSION['usuario']['nombre']) ?> · <a class="text-white" href="<?= e($basePath) ?>/index.php?action=logout">Salir</a></span>
  </div>
</nav>
<main class="container py-4">
