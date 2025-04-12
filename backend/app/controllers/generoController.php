<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/genero.php";

class GeneroController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function read()
    {
        if (!$this->conn) {
            return ["error" => "Erro na conexão com o banco de dados."];
        }

        try {
            $genero = new Genero($this->conn);
            return $genero->read();
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function create($dados)
    {
        $genero = new Genero($this->conn);
        $genero->nome = $dados['nome'] ?? '';

        return $genero->create();
    }

    public function update($id, $dados)
    {
        $genero = new Genero($this->conn);
        $genero->id = $id;
        $genero->nome = $dados['nome'] ?? '';

        return $genero->update();
    }

    public function delete($id)
    {
        $genero = new Genero($this->conn);
        $genero->id = $id;
        return $genero->delete();
    }
}