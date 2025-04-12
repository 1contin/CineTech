<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . "/../../backend/app/config/database.php";
require_once __DIR__ . "/../../backend/app/controllers/filmeController.php";
require_once __DIR__ . "/../../backend/app/models/filme.php";

$database = new Database();
$pdo = $database->conectar();
$filmeController = new FilmeController($pdo);
$originalMethod = $_SERVER["REQUEST_METHOD"];
$method = $originalMethod === 'POST' && isset($_GET['_method']) ? strtoupper($_GET['_method']) : $originalMethod;

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

switch ($method) {
    case "GET":
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $filme = $filmeController->readById($id);

            if ($filme) {
                echo json_encode([
                    "success" => true,
                    "data" => [$filme]
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Filme não encontrado."
                ]);
            }
        } else {
            $filmes = $filmeController->read();
            echo json_encode([
                "success" => true,
                "data" => $filmes
            ]);
        }
        break;

    case "POST":
        if (isset($_POST['titulo'])) {
            $resultado = $filmeController->create($_POST, $_FILES);
        } else {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['titulo']) || empty($dados['descricao'])) {
                echo json_encode([
                    "success" => false,
                    "message" => "Título e descrição são obrigatórios."
                ]);
                return;
            }

            $resultado = $filmeController->create($dados, []);
        }

        echo json_encode([
            "success" => $resultado === true,
            "message" => $resultado === true ? "Filme cadastrado com sucesso!" : (is_string($resultado) ? $resultado : "Erro ao cadastrar o filme.")
        ]);
        break;

        case "PUT":
            $id = $_POST['id'] ?? null;
        
            if ($id) {
                $dados = [
                    'titulo' => $_POST['titulo'] ?? null,
                    'descricao' => $_POST['descricao'] ?? null,
                    'trailer' => $_POST['trailer'] ?? null,
                    'trailer_iframe' => $_POST['trailer_iframe'] ?? null,
                    'data_lancamento' => $_POST['data_lancamento'] ?? null,
                    'duracao' => $_POST['duracao'] ?? null,
                    'genero_id' => $_POST['genero_id'] ?? null,
                    'capa' => $_POST['capa'] ?? null,
                ];
        
                if (empty($dados['titulo']) || empty($dados['descricao'])) {
                    echo json_encode([
                        "success" => false,
                        "message" => "Título e descrição são obrigatórios."
                    ]);
                    return;
                }
        
                $sucesso = $filmeController->update($id, $dados, $_FILES);
                echo json_encode([
                    "success" => $sucesso === true,
                    "message" => $sucesso === true ? "Filme atualizado com sucesso!" : "Erro ao atualizar o filme."
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "ID não fornecido"
                ]);
            }
            break;

    case "DELETE":
        $input = file_get_contents("php://input");
        error_log("INPUT RECEBIDO NO DELETE: " . $input);

        $dados = json_decode($input, true);
        $id = $dados["id"] ?? null;

        if (!$id) {
            error_log("ID não encontrado no corpo da requisição!");
            echo json_encode(["success" => false, "message" => "ID do filme não fornecido."]);
            return;
        }

        $sucesso = $filmeController->delete($id);
        echo json_encode(["success" => $sucesso]);
        break;

    default:
        echo json_encode(["message" => "Método não permitido"]);
}
