<?php
class Database {
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($host, $user, $password, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }

        echo "Lidhja me bazën e të dhënave është kryer me sukses!";
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
            echo "Lidhja me bazën e të dhënave është mbyllur.";
        }
    }
}
?>
