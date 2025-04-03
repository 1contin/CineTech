<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <?php include '../partials/header.php'; ?>
    <main class="container mt-4">
        <h2 class="mb-4 gradient-text">Dashboard Administrativo</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title gradient-text">Filmes Cadastrados</h5>
                        <p class="card-text">Total de filmes cadastrados: <span id="total-filmes">0</span></p>
                        <div class="table-responsive">
                            <table id="filmes-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Gênero</th>
                                        <th>Data de lançamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <a href="/cineTech/app/views/admin/cadastrar_filme.php" id="cadastrarFilme" class="btn btn-primary btn-sm mt-3">Adicionar Filmes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title gradient-text">Gêneros Disponíveis</h5>
                        <p class="card-text">Total de gêneros disponíveis: <span id="total-generos">0</span></p>
                        <div class="table-responsive">
                            <table id="generos-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Gênero</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <a href="/cineTech/app/views/admin/cadastrar_genero.php" class="btn btn-primary btn-sm mt-3">Adicionar Gênero</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../../../public/assets/js/adminFilmes.js"></script>
    <script src="../../../public/assets/js/adminGeneros.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php include '../partials/footer.php'; ?>
</body>

</html>