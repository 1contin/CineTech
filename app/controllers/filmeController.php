<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Filme.php";

class FilmeController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function read()
    {
        $filme = new Filme($this->conn);
        return $filme->read();
    }

    public function readById($id)
    {
        $filme = new Filme($this->conn);
        return $filme->readById($id);
    }

    public function create($dados)
    {
        $filme = new Filme($this->conn);
        $filme->titulo = $dados['titulo'];
        $filme->descricao = $dados['descricao'];
        $filme->capa = $dados['capa'];
        $filme->trailer = $dados['trailer'];
        $filme->trailer_iframe = $dados['trailer_iframe'];
        $filme->genero_id = $dados['genero_id'];
        $filme->data_lancamento = $dados['data_lancamento'];
        $filme->duracao = $dados['duracao'];

        return $filme->create($dados);
    }

    public function update($id, $dados)
    {
        $filme = new Filme($this->conn);
        $dados['id'] = $id;

        return $filme->update($dados);
    }

    public function delete($id)
    {
        $filme = new Filme($this->conn);
        return $filme->delete($id);
    }

    public function getFilmeById($id)
    {
        $filme = new Filme($this->conn);
        return $filme->readById($id);
    }

    public function getConn()
    {
        return $this->conn;
    }
}
?>