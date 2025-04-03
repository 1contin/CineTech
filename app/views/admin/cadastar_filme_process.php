<?php

require_once __DIR__ . "../../../config/database.php";
require_once __DIR__ . "../../../models/filme.php";

$database = new Database();
$pdo = $database->conectar();

$filmeModel = new Filme($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dados = [
        "titulo" => $_POST["titulo"],
        "descricao" => $_POST["descricao"],
        "capa" => $_POST["capa"],
        "trailer" => $_POST["trailer"],
        "trailer_iframe" => $_POST["trailer_iframe"],
        "genero_id" => $_POST["genero_id"],
        "data_lancamento" => $_POST["data_lancamento"],
        "duracao" => $_POST["duracao"],
    ];

    if ($filmeModel->create($dados)) {
        header("Location: dashboard.php"); 
        exit;
    } else {
        echo "Erro ao cadastrar o filme.";
    }
}
?>