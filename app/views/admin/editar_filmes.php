<?php
require_once __DIR__ . "../../../controllers/filmeController.php";
require_once __DIR__ . "../../../models/genero.php";

$filmeController = new FilmeController();
$idFilme = $_GET["id"] ?? null;

if (!$idFilme) {
    echo "ID do filme não fornecido.";
    exit;
}

$filme = $filmeController->getFilmeById($idFilme);

if (!$filme) {
    echo "Filme não encontrado.";
    exit;
}

$genero = new Genero($filmeController->getConn());
$generos = $genero->read();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dados = [
        "titulo" => $_POST["titulo"],
        "descricao" => $_POST["descricao"],
        "capa" => $_POST["capa"],
        "trailer" => $_POST["trailer"],
        "genero_id" => $_POST["genero_id"],
        "data_lancamento" => $_POST["data_lancamento"],
        "duracao" => $_POST["duracao"],
        "trailer_iframe" => $_POST["trailer_iframe"],
    ];

    if ($filmeController->update($idFilme, $dados)) {
        header("Location: ../../admin/dashboard.php");
        exit;
    } else {
        echo "Erro ao atualizar o filme.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>
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
            <h2 class="gradient-text mt-3">Editar Filme</h2>
        </div>
        <div class="card p-4">
            <form action="atualizar_filme.php" method="post">
                <input type="hidden" name="id" value="<?php echo $filme['id']; ?>">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $filme['titulo']; ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="3" class="form-control"><?php echo $filme['descricao']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="capa" class="form-label">Capa:</label>
                    <input type="text" id="capa" name="capa" value="<?php echo $filme['capa']; ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="trailer" class="form-label">Trailer:</label>
                    <input type="text" id="trailer" name="trailer" value="<?php echo $filme['trailer']; ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="trailer_iframe" class="form-label">Trailer Iframe:</label>
                    <textarea id="trailer_iframe" name="trailer_iframe" rows="3" class="form-control"><?php echo htmlspecialchars($filme['trailer_iframe']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="genero_id" class="form-label">Gênero:</label>
                    <select id="genero_id" name="genero_id" class="form-select">
                        <?php foreach ($generos as $row_genero): ?>
                            <option value="<?php echo $row_genero['id']; ?>" <?php echo ($row_genero['id'] == $filme['genero_id']) ? 'selected' : ''; ?>>
                                <?php echo $row_genero['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="data_lancamento" class="form-label">Data de Lançamento:</label>
                    <input type="date" id="data_lancamento" name="data_lancamento" value="<?php echo $filme['data_lancamento']; ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="duracao" class="form-label">Duração em Minutos</label>
                    <input type="number" class="form-control" id="duracao" name="duracao" value="<?php echo $filme['duracao'] ?? ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </main>
</body>

</html>