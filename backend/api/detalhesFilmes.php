<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../../backend/app/config/database.php";
require_once __DIR__ . "/../../backend/app/models/filme.php";
require_once __DIR__ . "/../../backend/app/controllers/filmeController.php";

try {
    $database = new Database();
    $pdo = $database->conectar();
    $controller = new FilmeController($pdo); // Passa a conexão PDO para o controller

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $filme = $controller->readById($id);

        if ($filme) {
            echo json_encode($filme);
        } else {
            echo json_encode(["success" => false, "message" => "Filme não encontrado."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "ID do filme não fornecido."]);
    }
} catch (PDOException $e) {
    error_log("Erro no banco de dados: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Erro no banco de dados."]);
} catch (Exception $e) {
    error_log("Erro geral: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Erro geral no servidor."]);
}