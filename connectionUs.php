<?php

class ConnectionUs {
    public function connect() {
        try {
            $dsn = "mysql:host=localhost;dbname=logindb;charset=utf8mb4";
            /* aici sunt datele bazei de date!! */
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Eroare conexiune DB: " . $e->getMessage());
        }
    }
}


