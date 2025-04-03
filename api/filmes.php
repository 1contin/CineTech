<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . "/../app/controllers/filmeController.php";

$filmeController = new FilmeController();
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        $filmes = $filmeController->read();
        echo json_encode($filmes);
        break;
    case "POST":
        $dados = json_decode(file_get_contents("php://input"), true);
        echo json_encode(["success" => $filmeController->create($dados)]);
        break;
    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT["id"] ?? null;
        echo json_encode(["success" => $filmeController->update($id, $_PUT)]);
        break;
    case "DELETE":
        $dados = json_decode(file_get_contents("php://input"), true);
        $id = $dados["id"] ?? null; 
        echo json_encode(["success" => $filmeController->delete($id)]); 
        break;
    default:
        echo json_encode(["message" => "Método não permitido"]);
}
?>