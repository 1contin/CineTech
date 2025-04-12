<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/filme.php";

class FilmeController
{
    private $conn;
    private $filmeModel;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
        $this->filmeModel = new Filme($this->conn);
    }

    public function read()
    {
        return $this->filmeModel->read();
    }

    public function readById($id)
    {
        return $this->filmeModel->readById($id);
    }

    public function create($dados, $arquivos = [])
    {
        if (isset($arquivos['capa']) && $arquivos['capa']['error'] === UPLOAD_ERR_OK) {
            $arquivoTmp = $arquivos['capa']['tmp_name'];
            $tipoMime = mime_content_type($arquivoTmp);

            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!in_array($tipoMime, $tiposPermitidos)) {
                return ["success" => false, "message" => "Somente arquivos de imagem são permitidos."];
            }

            $nomeArquivo = uniqid() . "-" . basename($arquivos['capa']['name']);
            $caminhoDestino = __DIR__ . "/../../../frontend/public/img/" . $nomeArquivo;

            if (move_uploaded_file($arquivoTmp, $caminhoDestino)) {
                $dados['capa'] = "img/" . $nomeArquivo;
            } else {
                return ["success" => false, "message" => "Erro ao mover o arquivo."];
            }
        } else {
            $dados['capa'] = null;
        }

        $this->filmeModel->titulo = $dados['titulo'];
        $this->filmeModel->descricao = $dados['descricao'];
        $this->filmeModel->capa = $dados['capa'];
        $this->filmeModel->trailer = $dados['trailer'];
        $this->filmeModel->trailer_iframe = $dados['trailer_iframe'];
        $this->filmeModel->genero_id = $dados['genero_id'] ?? null;
        $this->filmeModel->data_lancamento = $dados['data_lancamento'];
        $this->filmeModel->duracao = $dados['duracao'];

        return $this->filmeModel->create($dados);
    }

    public function update($id, $dados, $arquivos = [])
    {
        $dados['id'] = $id;

        if (isset($arquivos['capa']) && $arquivos['capa']['error'] === UPLOAD_ERR_OK) {
            error_log("Verificando a imagem enviada para a capa: " . print_r($arquivos['capa'], true));

            $arquivoTmp = $arquivos['capa']['tmp_name'];
            $tipoMime = mime_content_type($arquivoTmp);
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

            if (!in_array($tipoMime, $tiposPermitidos)) {
                return ["success" => false, "message" => "Somente arquivos de imagem são permitidos."];
            }

            $nomeArquivo = uniqid() . "-" . basename($arquivos['capa']['name']);
            $caminhoDestino = __DIR__ . "/../../../frontend/public/img/" . $nomeArquivo;

            if (move_uploaded_file($arquivoTmp, $caminhoDestino)) {
                $dados['capa'] = "img/" . $nomeArquivo;
                error_log("Imagem de capa movida com sucesso para: " . $dados['capa']);
            } else {
                return ["success" => false, "message" => "Erro ao mover o arquivo."];
            }
        }

        if (isset($dados['genero_id']) && !empty($dados['genero_id'])) {
            $this->filmeModel->genero_id = $dados['genero_id'];
            error_log("Gênero recebido: " . print_r($dados['genero_id'], true));
        }

        error_log("Dados que serão atualizados no banco: " . print_r($dados, true));

        $this->filmeModel->titulo = $dados['titulo'];
        $this->filmeModel->descricao = $dados['descricao'];
        $this->filmeModel->capa = $dados['capa'];
        $this->filmeModel->trailer = $dados['trailer'];
        $this->filmeModel->trailer_iframe = $dados['trailer_iframe'];
        $this->filmeModel->data_lancamento = $dados['data_lancamento'];
        $this->filmeModel->duracao = $dados['duracao'];

        return $this->filmeModel->update($dados);
    }

    public function delete($id)
    {
        if (!$id) {
            return false;
        }

        try {
            $stmt = $this->conn->prepare("SELECT capa FROM filmes WHERE id = ?");
            $stmt->execute([$id]);
            $filme = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($filme && $filme['capa']) {
                $caminhoImagem = __DIR__ . "/../../../frontend/public/" . $filme['capa'];

                if (file_exists($caminhoImagem)) {
                    unlink($caminhoImagem);
                }
            }

            $stmt = $this->conn->prepare("DELETE FROM filmes WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erro ao deletar filme: " . $e->getMessage());
            return false;
        }
    }
}
