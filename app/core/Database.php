<?php

trait Database {
    private $host = "db";
    private $db_name = "app_db";
    private $username = "user";
    private $password = "pass";
    private $conn;
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

    if(!$check){
        return false;
    }

    $queryType = strtoupper(strtok(trim($query), " "));

    switch($queryType){

        case 'SELECT':
            return $stm->fetchAll();

        case 'INSERT':
            return $con->lastInsertId();

        default:
            return true;
    }
}

}