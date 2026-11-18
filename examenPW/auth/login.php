<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/config/database.php';

if (!empty($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $statement = $pdo->prepare('SELECT * FROM usuarios WHERE email = ? LIMIT 1');
    $statement->execute([trim($_POST['email'] ?? '')]);
    $usuario = $statement->fetch();
    
    if ($usuario && password_verify($_POST['password'] ?? '', $usuario['password'])) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol'],
        ];
        header('Location: ../index.php');
        exit;
    }
    $error = 'Correo o contraseña incorrectos.';
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Acceso | Centro de Acopio</title>
</head>
<body class="bg-light">
<main class="container py-5" style="max-width:480px">
  <div class="card shadow-sm"><div class="card-body p-4">
    <h1 class="h3 mb-4">Centro de Acopio</h1>
    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <label class="form-label">Correo</label>
      <input class="form-control mb-3" type="email" name="email" required>
      <label class="form-label">Contraseña</label>
      <input class="form-control mb-3" type="password" name="password" required>
      <button class="btn btn-primary w-100">Iniciar sesión</button>
    </form>
    <p class="text-muted small mt-3 mb-0">Usuario inicial: admin@acopio.local / password</p>
  </div></div>
</main>
</body>
</html>
