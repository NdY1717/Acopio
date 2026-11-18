<?php
declare(strict_types=1);

function processCrudRequest(PDO $pdo, string $module, array $definition): string
{
    check_csrf();

    $id = (int) ($_POST['id'] ?? 0);
    if (($_POST['operation'] ?? '') === 'delete') {
        if ($module !== 'usuarios') {
            try {
                $statement = $pdo->prepare("DELETE FROM {$definition['table']} WHERE id = ?");
                $statement->execute([$id]);
            } catch (PDOException) {
                return 'No se puede eliminar porque el registro está relacionado con donaciones o salidas.';
            }
        }

        return '';
    }

    $columns = array_keys($definition['fields']);
    $values = array_map(
        fn(string $column): string => trim($_POST[$column] ?? ''),
        $columns
    );

    if ($module === 'usuarios') {
        $passwordIndex = array_search('password', $columns, true);
        if ($id > 0 && $values[$passwordIndex] === '') {
            unset($columns[$passwordIndex], $values[$passwordIndex]);
            $columns = array_values($columns);
            $values = array_values($values);
        } else {
            $values[$passwordIndex] = password_hash($values[$passwordIndex], PASSWORD_DEFAULT);
        }
    }

    if ($module === 'donaciones' && $values[0] === '0') {
        $values[0] = null;
    }

    if ($id > 0) {
        $set = implode(', ', array_map(fn(string $column): string => "{$column} = ?", $columns));
        $statement = $pdo->prepare("UPDATE {$definition['table']} SET {$set} WHERE id = ?");
        $statement->execute([...$values, $id]);
    } else {
        $statement = $pdo->prepare(
            "INSERT INTO {$definition['table']} (" . implode(', ', $columns) . ") VALUES (" .
            implode(', ', array_fill(0, count($columns), '?')) . ')'
        );
        $statement->execute($values);
    }

    return '';
}

//Consulta todos los registros de la tabla correspondiente al módulo
function fetchCrudRows(PDO $pdo, array $definition): array
{
    return $pdo->query("SELECT * FROM {$definition['table']} ORDER BY id DESC")->fetchAll();
}

//Consulta un registro específico de la tabla correspondiente al módulo
function fetchCrudEditing(PDO $pdo, array $definition, ?int $id): ?array
{
    if (!$id) {
        return null;
    }

    $statement = $pdo->prepare("SELECT * FROM {$definition['table']} WHERE id = ?");
    $statement->execute([$id]);

    return $statement->fetch() ?: null;
}
