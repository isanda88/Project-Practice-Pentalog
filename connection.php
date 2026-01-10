<?php
class Connection{
    
    public function connect()
    {
        try{
            $dsn = "mysql:host=localhost;dbname=library;charset=utf8mb4";
            $pdo = new PDO ($dsn,'root','');
            $pdo -> setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
               return $pdo;
        }
        catch(Exception $e){ 
            echo 'eroare' . $e->getMessage();
        }

    }
}