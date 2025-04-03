<?php
require_once __DIR__ . "/../../../app/controllers/filmeController.php";

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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        </head>

        <body>
            <?php include '../partials/header.php'; ?>
            <main class="container mt-4">
                <div class="card filme-card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= $filme['capa'] ?>" alt="<?= $filme['titulo'] ?>" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $filme['titulo'] ?></h5>
                                <p class="card-text"><strong>Data de lançamento:</strong> <?= date('d/m/Y', strtotime($filme['data_lancamento'])) ?></p>
                                <p class="card-text"><strong>Gênero:</strong> <?= $filme['genero'] ?></p>
                                <p class="card-text"><strong>Duração:</strong> <?= $filme['duracao'] ?> minutos</p> 
                                <p class="card-text"><?= $filme['descricao'] ?></p>
                                <div class="d-flex">
                                    <a href="<?= $filme['trailer'] ?>" class="btn btn-primary btn-custom">Assistir Trailer</a>
                                    <a href="home.php" class="btn btn-secondary btn-custom ms-2">Voltar para o Catálogo</a>
                                </div>
                                <div class="mt-3">
                                    <?php
                                    $isAdminPage = isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], '/admin/') !== false;
                                    if ($isAdminPage) {
                                        echo '<a href="/cineTech/app/views/admin/dashboard.php" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Voltar para a Dashboard</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4">
                        <h3 class="card-title">Trailer</h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <?php
                            if (isset($filme['trailer_iframe'])) {
                                echo $filme['trailer_iframe'];
                            } else {
                                echo '<p class="card-text">Trailer não disponível.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../partials/footer.php'; ?>
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