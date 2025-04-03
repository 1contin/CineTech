<?php
require_once __DIR__ . "../../config/database.php";

class LoginController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function login($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM admin_user WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'] ?? null;
                $_SESSION['is_admin'] = ($user['role'] === 'admin');
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao fazer login: " . $e->getMessage();
            return false;
        }
    }


    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /cineTech/app/views/pages/home.php");
        exit;
    }

    public function checkAuth()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public function getUserRole()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['role'] ?? null;
    }

    public function processLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['usuario']);
            $password = trim($_POST['senha']);

            if (empty($username) || empty($password)) {
                header("Location: /cineTech/app/views/pages/login.php?error=2"); 
                exit;
            }

            if (strlen($username) > 50 || strlen($password) > 50) {
                header("Location: /cineTech/app/views/pages/login.php?error=3");
                exit;
            }

            if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                header("Location: /cineTech/app/views/pages/login.php?error=4");
                exit;
            }

            if ($this->login($username, $password)) {
                header("Location: /cineTech/app/views/admin/dashboard.php");
                exit;
            } else {
                header("Location: /cineTech/app/views/pages/login.php?error=1"); 
                exit;
            }
        }
    }

    public function processLogout()
    {
        $this->logout();
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $loginController = new LoginController();
    $loginController->processLogout();
}
