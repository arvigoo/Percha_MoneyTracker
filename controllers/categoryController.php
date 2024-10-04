<?php
require_once 'models/Categories.php';
require_once 'config/config.php';

class CategoryController {
    private $db;
    private $category;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->category = new Category($this->db);
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /public/index.php?view=auth/login");
            exit;
        }

        $user_id = $_SESSION['user'];
        $categories = $this->category->readAll($user_id);

        include 'views/category/index.php';
    }

    public function create() {
        session_start();
        if ($_POST) {
            $this->category->user_id = $_SESSION['user'];
            $this->category->name = $_POST['name'];

            if ($this->category->create()) {
                header("Location: /public/index.php?view=category/index");
            } else {
                echo "Category creation failed!";
            }
        }
        else {
            require_once 'views/auth/create.php';
        }
    }
}
?>
