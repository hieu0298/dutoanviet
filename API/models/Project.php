<?php
class Project {
    private $conn;
    private $table = 'projects';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . "
                SET
                    user_id = :user_id,
                    name = :name,
                    description = :description";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function getUserProjects($userId) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 