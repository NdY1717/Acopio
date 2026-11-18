# Centro de Acopio

## Puesta en marcha con XAMPP

1. Inicia **Apache** y **MySQL** desde el panel de XAMPP.
2. Abre `http://localhost/phpmyadmin`.
3. Importa el archivo `database/database.sql`.
4. Abre `http://localhost/examenPW/`.

Usuario inicial: `admin@acopio.local`  
Contraseña inicial: `password`

La conexión usa el usuario `root` sin contraseña, que es la configuración predeterminada de XAMPP. Si tu instalación usa otra contraseña, actualiza `config/database.php`.

El panel incluye CRUD para usuarios, materiales, proveedores, donaciones y salidas.

## Estructura

- `index.php`: entrada y panel principal.
- `auth/login.php`: inicio de sesión.
- `modules/`: páginas de cada módulo (`usuarios.php`, `materiales.php`, `proveedores.php`, `donaciones.php` y `salidas.php`).
- `controllers/dashboard.php`: controlador del panel principal.
- `controllers/crud.php`: controlador reutilizable de los módulos CRUD.
- `config/database.php`: conexión y funciones de sesión.
- `database/database.sql`: estructura y datos iniciales de la base de datos.
- `includes/modules.php`: configuración de módulos y campos.
- `includes/crud.php`: operaciones de consulta, alta, edición y eliminación.
- `includes/`: plantilla visual compartida y lógica reutilizable.
- `views/crud.php`: vista reutilizable del CRUD.
- `views/dashboard.php`: vista del panel principal.
