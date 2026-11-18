<?php
declare(strict_types=1);

$modules = [
    'usuarios' => ['title' => 'Usuarios', 'table' => 'usuarios', 'fields' => [
        'nombre' => ['label' => 'Nombre', 'type' => 'text'],
        'email' => ['label' => 'Correo', 'type' => 'email'],
        'password' => ['label' => 'Contraseña', 'type' => 'password'],
        'rol' => ['label' => 'Rol', 'type' => 'select', 'options' => [
            'admin' => 'Administrador',
            'capturista' => 'Capturista',
        ]],
    ]],
    'materiales' => ['title' => 'Materiales', 'table' => 'materiales', 'fields' => [
        'nombre' => ['label' => 'Nombre', 'type' => 'text'],
        'categoria' => ['label' => 'Categoría', 'type' => 'text'],
        'unidad' => ['label' => 'Unidad', 'type' => 'text'],
        'existencia' => ['label' => 'Existencia', 'type' => 'number'],
        'minimo' => ['label' => 'Mínimo', 'type' => 'number'],
    ]],
    'proveedores' => ['title' => 'Proveedores', 'table' => 'proveedores', 'fields' => [
        'nombre' => ['label' => 'Nombre', 'type' => 'text'],
        'telefono' => ['label' => 'Teléfono', 'type' => 'text'],
        'email' => ['label' => 'Correo', 'type' => 'email'],
        'direccion' => ['label' => 'Dirección', 'type' => 'text'],
    ]],
    'donaciones' => ['title' => 'Donaciones', 'table' => 'donaciones', 'fields' => [
        'proveedor_id' => ['label' => 'Proveedor', 'type' => 'select', 'options' => []],
        'material_id' => ['label' => 'Material', 'type' => 'select', 'options' => []],
        'cantidad' => ['label' => 'Cantidad', 'type' => 'number'],
        'fecha' => ['label' => 'Fecha', 'type' => 'date'],
        'observaciones' => ['label' => 'Observaciones', 'type' => 'text'],
    ]],
    'salidas' => ['title' => 'Salidas', 'table' => 'salidas', 'fields' => [
        'material_id' => ['label' => 'Material', 'type' => 'select', 'options' => []],
        'cantidad' => ['label' => 'Cantidad', 'type' => 'number'],
        'beneficiario' => ['label' => 'Beneficiario', 'type' => 'text'],
        'fecha' => ['label' => 'Fecha', 'type' => 'date'],
        'observaciones' => ['label' => 'Observaciones', 'type' => 'text'],
    ]],
];

$providerOptions = $pdo->query('SELECT id, nombre FROM proveedores ORDER BY nombre')->fetchAll();
$materialOptions = $pdo->query('SELECT id, nombre FROM materiales ORDER BY nombre')->fetchAll();
$modules['donaciones']['fields']['proveedor_id']['options'] = [0 => 'Sin proveedor'] + array_column($providerOptions, 'nombre', 'id');
$modules['donaciones']['fields']['material_id']['options'] = array_column($materialOptions, 'nombre', 'id');
$modules['salidas']['fields']['material_id']['options'] = array_column($materialOptions, 'nombre', 'id');
