<?php
require_once __DIR__ . "/../../CineTech/app/controllers/filmeController.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $controller = new FilmeController();
    $filme = $controller->getFilmeById($id);

    if ($filme) {
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalhes do Filme - <?= $filme['titulo'] ?></title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../../../public/assets/css/style.css">
        </head>
        <body>
            <?php include '../../partials/header.php'; ?>
            <main class="container mt-4">
                <h2><?= $filme['titulo'] ?></h2>
                <img src="<?= $filme['capa'] ?>" alt="<?= $filme['titulo'] ?>" class="img-fluid mb-3">
                <p><?= $filme['descricao'] ?></p>
                <p><strong>Gênero:</strong> <?= $filme['genero'] ?></p>
                <p><strong>Trailer:</strong> <a href="<?= $filme['trailer'] ?>" target="_blank">Assistir</a></p>
                <p><strong>Data de Lançamento:</strong> <?= $filme['data_lancamento'] ?></p>
                <p><strong>Duração:</strong> <?= $filme['duracao'] ?> minutos</p>
                <a href="../home.php" class="btn btn-secondary mt-3">Voltar para o Catálogo</a>
            </main>
            <?php include '../../partials/footer.php'; ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Filme não encontrado.";
    }
} else {
    echo "ID do filme não fornecido.";
}
?>