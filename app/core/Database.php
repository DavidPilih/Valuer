<?php

class Database {
    private $host = "db";
    private $db_name = "app_db";
    private $username = "user";
    private $password = "pass";
    private $conn;

    // Metoda, ki vzpostavi povezavo in jo vrne
    public function connect() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            $this->conn = new PDO($dsn, $this->username, $this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
        } catch(PDOException $e) {
            echo "Napaka pri povezavi z bazo: " . $e->getMessage();
            die();
        }

        return $this->conn;
    }

    public function query($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if ($check) {
            $result = $stm->fetchAll();
            if (is_array($result) && count($result) > 0) {
                return $result;
            }
        }
        return false;
    }
}