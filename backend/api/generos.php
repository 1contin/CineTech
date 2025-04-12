<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . "/../../backend/app/controllers/generoController.php";

$generoController = new GeneroController();
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        $generos = $generoController->read();
    
        // Verifica se houve erro
        if (isset($generos["error"])) {
            echo json_encode([
                "success" => false,
                "message" => $generos["error"]
            ]);
        } else {
            echo json_encode([
                "success" => true,
                "data" => $generos
            ]);
        }
        break;

    case "POST":
        $dados = json_decode(file_get_contents("php://input"), true);
        echo json_encode(["success" => $generoController->create($dados)]);
        break;

    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT["id"] ?? null;
        echo json_encode(["success" => $generoController->update($id, $_PUT)]);
        break;

    case "DELETE":
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data["id"] ?? null;  
        if ($id) {
            echo json_encode(["success" => $generoController->delete($id)]);
        } else {
            echo json_encode(["error" => "ID não fornecido"]);
        }
        break;

    default:
        echo json_encode(["message" => "Método não permitido"]);
}
?>