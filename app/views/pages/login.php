<?php require_once __DIR__ . "../../../controllers/loginController.php";
$loginController = new LoginController();
$loginController->processLogin();

// Exibe mensagens de erro com base nos códigos de erro
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    switch ($error) {
        case 1:
            $errorMessage = "Usuário ou senha incorretos.";
            break;
        case 2:
            $errorMessage = "Preencha todos os campos.";
            break;
        case 3:
            $errorMessage = "Comprimento máximo excedido.";
            break;
        case 4:
            $errorMessage = "Nome de usuário inválido.";
            break;
        default:
            $errorMessage = "Ocorreu um erro.";
            break;
    }
    echo '<div class="error-message">' . $errorMessage . '</div>';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>

<body>
    <?php include '../partials/header.php' ?>
    <main class="container mt-4">
        <div class="login-container">
            <div class="admin-container">
                <h2><span class="gradient-text">CineTech</span></h2>
                <div style="text-align: center;"> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="url(#personGradient)" class="bi bi-person-circle logo-svg" viewBox="0 0 16 16">
                        <defs>
                            <linearGradient id="personGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#a172fc;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#fc72fc;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    <h5><span class="gradient-text">Admin</span></h5>
                </div>
                <p>Acesso restrito</p>
            </div>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <div class="separator">
                        <label for="usuarioInput" id="usuarioLabel">Usuário</label>
                    </div>
                    <input type="text" id="usuarioInput" name="usuario" required onfocus="ocultarLabel('usuarioLabel')" onblur="exibirLabel('usuarioInput', 'usuarioLabel')">
                </div>

                <div class="input-group">
                    <div class="separator">
                        <label for="senhaInput" id="senhaLabel">Senha</label>
                    </div>
                    <input type="password" id="senhaInput" name="senha" required onfocus="ocultarLabel('senhaLabel')" onblur="exibirLabel('senhaInput', 'senhaLabel')">
                </div>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </main>
    <?php include '../partials/footer.php' ?>
    <script src="../../../public/assets/js/interacaoInput.js"></script>
</body>

</html>