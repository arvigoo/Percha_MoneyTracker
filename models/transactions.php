<?php
require_once 'config/config.php';

class Transaction {
    private $conn;
    private $table_name = "transactions_mst";

    public $id;
    public $user_id;
    public $category_id;
    public $amount;
    public $date;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, category_id, amount, transaction_date, description) VALUES (:user_id, :category_id, :amount, :date, :description)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readAll($user_id) {
        $query = "SELECT trans.*,
                         cat.name
                  FROM " . $this->table_name . " trans
                  LEFT JOIN Categories_mst cat
                        on trans.category_id = cat.category_id 
                  WHERE user_id = :user_id ORDER BY transaction_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
