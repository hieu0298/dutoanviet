<?php
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . "
                SET
                    username = :username,
                    password = :password,
                    email = :email,
                    fullname = :fullname,
                    phone = :phone";
        
        $stmt = $this->conn->prepare($query);
        
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return $stmt->execute($data);
    }

    public function login($username, $password) {
        try {
            $query = "SELECT id, username, email, password, fullname 
                     FROM " . $this->table . " 
                     WHERE username = :username";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (password_verify($password, $row['password'])) {
                    // Không trả về password
                    unset($row['password']);
                    return $row;
                }
            }
            
            return false;
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            throw new Exception("Database error occurred");
        }
    }

    public function createPasswordReset($email, $token, $expiry) {
        // Kiểm tra email tồn tại
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        
        if ($stmt->rowCount() == 0) {
            return false;
        }

        // Lưu token reset password
        $query = "INSERT INTO password_resets (email, token, expiry) 
                  VALUES (:email, :token, :expiry)
                  ON DUPLICATE KEY UPDATE 
                  token = :token, expiry = :expiry";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'email' => $email,
            'token' => $token,
            'expiry' => $expiry
        ]);
    }

    public function resetPassword($token, $newPassword) {
        // Kiểm tra token hợp lệ và chưa hết hạn
        $query = "SELECT email FROM password_resets 
                  WHERE token = :token AND expiry > NOW() 
                  AND used = 0";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['token' => $token]);
        
        if ($stmt->rowCount() == 0) {
            return false;
        }
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $result['email'];

        // Cập nhật mật khẩu mới
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE " . $this->table . " 
                  SET password = :password 
                  WHERE email = :email";
        
        $stmt = $this->conn->prepare($query);
        $success = $stmt->execute([
            'password' => $hashedPassword,
            'email' => $email
        ]);

        if ($success) {
            // Đánh dấu token đã sử dụng
            $query = "UPDATE password_resets 
                      SET used = 1 
                      WHERE token = :token";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['token' => $token]);
        }

        return $success;
    }
} 