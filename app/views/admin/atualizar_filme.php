<?php
require_once __DIR__ . "../../../controllers/filmeController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filmeController = new FilmeController();

    $id = $_POST["id"];
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

    if ($filmeController->update($id, $dados)) {
        header("Location: /cineTech/app/views/admin/dashboard.php"); 
        exit;
    } else {
        echo "Erro ao atualizar o filme.";
    }
} else {
    echo "Método inválido.";
}
?>