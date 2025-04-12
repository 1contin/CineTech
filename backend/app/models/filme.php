<?php
require_once __DIR__ . "/../config/database.php";

class Filme
{
    private $conn;
    private $table_name = "filmes";

    public $id;
    public $titulo;
    public $descricao;
    public $capa;
    public $trailer;
    public $trailer_iframe;
    public $genero_id;
    public $data_lancamento;
    public $duracao;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($dados)
    {
        $query = "INSERT INTO " . $this->table_name . " 
            (titulo, descricao, capa, trailer, trailer_iframe, genero_id, data_lancamento, duracao) 
            VALUES 
            (:titulo, :descricao, :capa, :trailer, :trailer_iframe, :genero_id, :data_lancamento, :duracao)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $dados["titulo"]);
        $stmt->bindParam(":descricao", $dados["descricao"]);
        $stmt->bindParam(":capa", $dados["capa"]);
        $stmt->bindParam(":trailer", $dados["trailer"]);
        $stmt->bindParam(":trailer_iframe", $dados["trailer_iframe"]);
        $stmt->bindParam(":genero_id", $dados["genero"]);
        $stmt->bindParam(":data_lancamento", $dados["data_lancamento"]);
        $stmt->bindParam(":duracao", $dados["duracao"]);

        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT f.*, g.nome AS genero
            FROM " . $this->table_name . " f
            LEFT JOIN generos g ON f.genero_id = g.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id)
    {
        $query = "SELECT f.*, g.nome AS genero
            FROM " . $this->table_name . " f
            LEFT JOIN generos g ON f.genero_id = g.id
            WHERE f.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchById($id)
    {
        $sql = "SELECT * FROM filmes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($dados)
    {
        $query = "UPDATE " . $this->table_name . " 
            SET titulo = :titulo, descricao = :descricao, capa = :capa, trailer = :trailer, 
                trailer_iframe = :trailer_iframe, genero_id = :genero_id, 
                data_lancamento = :data_lancamento, duracao = :duracao
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $dados["titulo"]);
        $stmt->bindParam(":descricao", $dados["descricao"]);
        $stmt->bindParam(":capa", $dados["capa"]);
        $stmt->bindParam(":trailer", $dados["trailer"]);
        $stmt->bindParam(":trailer_iframe", $dados["trailer_iframe"]);
        $stmt->bindParam(":genero_id", $dados["genero_id"]);
        $stmt->bindParam(":data_lancamento", $dados["data_lancamento"]);
        $stmt->bindParam(":duracao", $dados["duracao"]);
        $stmt->bindParam(":id", $dados["id"]);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function readByGenero($genero)
    {
        $query = "SELECT f.*, g.nome AS genero
            FROM " . $this->table_name . " f
            LEFT JOIN generos g ON f.genero_id = g.id
            WHERE g.nome = :genero";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":genero", $genero);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByTitulo($titulo)
    {
        $query = "SELECT f.*, g.nome AS genero
            FROM " . $this->table_name . " f
            LEFT JOIN generos g ON f.genero_id = g.id
            WHERE f.titulo LIKE :titulo";

        $stmt = $this->conn->prepare($query);
        $titulo = '%' . $titulo . '%';
        $stmt->bindParam(":titulo", $titulo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}