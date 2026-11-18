<div class="d-flex justify-content-between align-items-center mb-4"><h1 class="h3"><?= e($pageTitle) ?></h1></div>
<?php if ($error): ?><div class="alert alert-warning"><?= e($error) ?></div><?php endif; ?>
  
<div class="row g-4">
  <div class="col-lg-4"><div class="card"><div class="card-body">
    <h2 class="h5"><?= $editing ? 'Editar registro' : 'Nuevo registro' ?></h2>
    <form method="post">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="id" value="<?= e($editing['id'] ?? 0) ?>">
      <?php foreach ($definition['fields'] as $name => $field): ?>
        <label class="form-label mt-2"><?= e($field['label']) ?></label>
        <?php if ($field['type'] === 'select'): ?>
          <select class="form-select" name="<?= e($name) ?>" required>
            <?php foreach ($field['options'] as $optionValue => $optionLabel): ?>
              <option value="<?= e($optionValue) ?>" <?= (string) ($editing[$name] ?? '') === (string) $optionValue ? 'selected' : '' ?>><?= e($optionLabel) ?></option>
            <?php endforeach; ?>
          </select>
        <?php else: ?>
          <input class="form-control" type="<?= e($field['type']) ?>" name="<?= e($name) ?>" value="<?= $field['type'] === 'password' ? '' : e($editing[$name] ?? '') ?>" <?= $name === 'nombre' || ($name === 'password' && !$editing) || ($name !== 'password' && $name !== 'observaciones') ? 'required' : '' ?>>
        <?php endif; ?>
      <?php endforeach; ?>
      <button class="btn btn-primary mt-3">Guardar</button>
      <?php if ($editing): ?><a class="btn btn-link mt-3" href="<?= e($page) ?>">Cancelar</a><?php endif; ?>
    </form>
  </div></div></div>
  <div class="col-lg-8"><div class="table-responsive"><table class="table table-striped align-middle">

    <thead><tr><th>ID</th><?php foreach ($definition['fields'] as $field): ?><th><?= e($field['label']) ?></th><?php endforeach; ?><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $row): ?><tr>
      <td><?= e($row['id']) ?></td>
      <?php foreach ($definition['fields'] as $name => $field): ?><td><?= $name === 'password' ? '********' : e($row[$name]) ?></td><?php endforeach; ?>
      <td class="text-nowrap">
        <a class="btn btn-sm btn-outline-secondary" href="<?= e($page) ?>?edit=<?= e($row['id']) ?>">Editar</a>
        <?php if ($module !== 'usuarios'): ?><form class="d-inline" method="post" onsubmit="return confirm('¿Eliminar este registro?')">
          <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
          <input type="hidden" name="operation" value="delete">
          <input type="hidden" name="id" value="<?= e($row['id']) ?>">
          <button class="btn btn-sm btn-outline-danger">Eliminar</button>
        </form><?php endif; ?>
      </td>
    </tr><?php endforeach; ?>
    <?php if (!$rows): ?><tr><td colspan="<?= count($definition['fields']) + 2 ?>" class="text-center">No hay registros.</td></tr><?php endif; ?>
    </tbody>
  </table></div></div>
</div>
