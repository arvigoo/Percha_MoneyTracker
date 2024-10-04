<?php
require_once 'models/transactions.php';
require_once 'models/Categories.php'; // Model untuk Category
require_once 'config/config.php';

class TransactionController {
    private $db;
    private $transaction;
    private $categories;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->transaction = new Transaction($this->db);
        $this->categories = new Category($this->db); // Model category
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?view=auth/login");
            exit;
        }

        $user_id = $_SESSION['user']['user_id'];
        // var_dump($_SESSION);
        $transactions = $this->transaction->readAll($user_id);

        include 'views/transactions/index.php';
    }
  
    public function create() {
        session_start();
        $categories = $this->categories->getAllCategories();
        if ($_POST) {
            $this->transaction->user_id = $_SESSION['user']['user_id'];
            $this->transaction->category_id = $_POST['category_id'];
            $this->transaction->amount = $_POST['amount'];
            $this->transaction->date = $_POST['transaction_date'];
            $this->transaction->description = $_POST['description'];

            if ($this->transaction->create()) {
                header("Location:index.php?view=transaction/index");
            } else {
                echo "Transaction creation failed!";
            }
        }
            include 'views/transactions/create.php';

        
    }
}
?>
