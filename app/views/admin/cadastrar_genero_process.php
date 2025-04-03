<?php

require_once __DIR__ . "../../../config/database.php";
require_once __DIR__ . "../../../models/genero.php";

$database = new Database();
$pdo = $database->conectar();
$generoModel = new Genero($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $generoModel->nome = $_POST["nome"];

    if ($generoModel->create()) {
        header("Location: dashboard.php"); 
        exit;
    } else {
        echo "Erro ao cadastrar o gênero.";
    }
}
?>