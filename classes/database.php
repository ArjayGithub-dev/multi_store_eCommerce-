<?php

class Database {

    private $host = 'localhost';
    // private $username = 'root';
    // private $password = '';
    // private $database = 'hts';

    private $username = 'u398014445_hts';
    private $password = 'JlM7P+8w';
    private $database = 'u398014445_hts';


    
    
    protected $connection;

    public function connect() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
                                        $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->connection;
    }
}

?>
