<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Panel principal</h1>
</div>
<div class="row g-3">
<?php foreach ($modules as $key => $definition): ?>
  <div class="col-md-6">
    <div class="card shadow-sm"><div class="card-body">
      <h2 class="h5"><?= e($definition['title']) ?></h2>
      <p class="display-6"><?= $counts[$key] ?></p>
      <a class="btn btn-outline-primary" href="<?= e($basePath) ?>/modules/<?= e($key) ?>.php">Administrar</a>
    </div></div>
  </div>
<?php endforeach; ?>
</div>
<div class="alert alert-info mt-4">Selecciona un módulo para crear, editar o eliminar registros.</div>
