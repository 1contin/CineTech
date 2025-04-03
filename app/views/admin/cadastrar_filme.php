<?php

require_once __DIR__ . "../../../config/database.php";
require_once __DIR__ . "../../../models/genero.php";

$database = new Database();
$pdo = $database->conectar();
$generoModel = new Genero($pdo);
$generos = $generoModel->read();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Filme</title>
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
            <h2 class="gradient-text mt-3">Cadastrar Genero</h2>
        </div>
        <form action="cadastar_filme_process.php" method="post" id="cadastrar-filme-form">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="capa" class="form-label">Capa</label>
                <input type="text" class="form-control" id="capa" name="capa" required>
            </div>
            <div class="mb-3">
                <label for="trailer" class="form-label">Trailer</label>
                <input type="text" class="form-control" id="trailer" name="trailer" required>
            </div>
            <div class="mb-3">
                <label for="trailer_iframe" class="form-label">Trailer Iframe</label>
                <textarea class="form-control" id="trailer_iframe" name="trailer_iframe" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="genero_id" class="form-label">Gênero</label>
                <select class="form-select" id="genero_id" name="genero_id" required>
                    <?php foreach ($generos as $row_genero): ?>
                        <option value="<?php echo $row_genero['id']; ?>"><?php echo $row_genero['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="data_lancamento" class="form-label">Data de Lançamento</label>
                <input type="date" class="form-control" id="data_lancamento" name="data_lancamento" required>
            </div>
            <div class="mb-3">
                <label for="duracao" class="form-label">Duração em Minutos</label>
                <input type="number" class="form-control" id="duracao" name="duracao" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </main>
    <?php include '../partials/footer.php'; ?>
</body>

</html>