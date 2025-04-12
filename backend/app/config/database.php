<?php
class Database
{
    private $host = "localhost";
    private $dbname = "cineTech";
    private $username = "root";
    private $password = "root"; 
    public $conn;

    public function conectar()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn; 
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
?>
