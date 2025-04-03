<?php
require_once __DIR__ . "../../../config/database.php";
require_once __DIR__ . "../../../models/filme.php";
require_once __DIR__ . "../../../models/genero.php";

$database = new Database();
$pdo = $database->conectar();
$filmeModel = new Filme($pdo);
$generoModel = new Genero($pdo);
$generos = $generoModel->read();

if (isset($_GET['search'])) {
    $filmes = $filmeModel->searchByTitulo($_GET['search']);

    foreach ($filmes as $filme) {
        echo '<div class="col-12 col-md-3 mb-4">';
        echo '<div class="card">';
        echo '<img src="' . $filme['capa'] . '" class="card-img-top" alt="' . $filme['titulo'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $filme['titulo'] . '</h5>';
        echo '<p class="card-text"><strong>Gênero:</strong> ' . $filme['genero'] . '</p>';
        echo '<a href="detalhes.php?id=' . $filme['id'] . '" class="btn btn-primary">Ver Detalhes</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    exit;
} elseif (isset($_GET['genero']) && $_GET['genero'] != 'todos') {
    $filmes = $filmeModel->readByGenero($_GET['genero']);
} else {
    $filmes = $filmeModel->read();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineTech - Catálogo de Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>

<body>
    <?php include '../partials/header.php' ?>
    <main class="container mt-4">
        <h2>Catálogo de Filmes</h2>
        <div class="row mb-3 align-items-center">
            <div class="col-12 col-md-6 mb-2 mb-md-0">
                <form method="get" action="home.php">
                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Buscar filmes...">
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <div class="d-flex flex-wrap justify-content-md-end">
                    <a href="home.php?genero=todos" class="btn btn-sm btn-outline-secondary m-1">Todos</a>
                    <?php foreach ($generos as $genero) : ?>
                        <a href="home.php?genero=<?= $genero['nome'] ?>" class="btn btn-sm btn-outline-secondary m-1"><?= $genero['nome'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="row" id="searchResults">
            <?php foreach ($filmes as $filme) : ?>
                <div class="col-12 col-md-3 mb-4">
                    <div class="card">
                        <img src="<?= $filme['capa'] ?>" class="card-img-top-home" alt="<?= $filme['titulo'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $filme['titulo'] ?></h5>
                            <p class="card-text"><strong>Gênero:</strong> <?= $filme['genero'] ?></p>
                            <p class="card-text"><strong>Data de lançamento:</strong> <?= $filme['data_lancamento'] ?></p>
                            <a href="detalhes.php?id=<?= $filme['id'] ?>" class="btn btn-primary">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include '../partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../public/assets/js/pesquisar.js"></script>
</body>

</html>