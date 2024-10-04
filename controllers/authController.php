<?php
require_once 'models/users.php';
require_once 'config/config.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if ($_POST) {
             // Ambil data dari form
                    $this->user->username = $_POST['username'] ?? '';  // Set nilai username
                    $this->user->email = $_POST['email'] ?? '';        // Set nilai email
                    $this->user->password = $_POST['password'] ?? '';  // Set nilai password

                    // Panggil method register() pada model User
                    if ($this->user->register()) {
                        // Jika berhasil, redirect ke halaman login
                        header("Location: index.php?view=auth/login");
                        exit;
                    } else {
                        // Jika gagal, tampilkan pesan error
                        echo "Registration failed!";
                    }
        } else {
            // Tampilkan formulir registrasi jika tidak ada data POST
            require_once 'views/auth/register.php';
        }
    }

    public function login() {
        if ($_POST) {
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            $loggedInUser = $this->user->login();

            if ($loggedInUser) {
                session_start();
                $_SESSION['user'] = $loggedInUser;
                echo "berhasil breee";
                header("Location: index.php?view=transaction/index");
            } else {
                echo "Login failed!";
            }
        }else{
            require_once 'views/auth/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location:index.php?view=auth/login");
    }
}
?>
