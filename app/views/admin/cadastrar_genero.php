<?php

require_once __DIR__ . "../../../config/database.php";
require_once __DIR__ . "../../../models/genero.php";

$database = new Database();
$pdo = $database->conectar();
$generoModel = new Genero($pdo);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Gênero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <?php include '../partials/header.php'; ?>
    <main class="container mt-4">
        <div class="mb-3">
            <a href="/cineTech/app/views/admin/dashboard.php" class="text-secondary">
                <i class="bi bi-arrow-bar-left"></i> Voltar para a dashboard administrativa
            </a>
            <h2 class="gradient-text mt-3">Cadastrar Gênero</h2>
        </div>
        <form action="cadastrar_genero_process.php" method="post" id="cadastrar-genero-form">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </main>
    <?php include '../partials/footer.php'; ?>
</body>

</html>