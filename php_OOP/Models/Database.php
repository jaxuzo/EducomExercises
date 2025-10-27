<?php

class Database {
    private mysqli $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            throw new Exception('Database connectie mislukt: ' . $this->conn->connect_error);
        }
        $this->conn->set_charset('utf8mb4');
    }

    public function query(string $sql, array $params = []): array {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) throw new Exception('Prepare mislukt: '.$this->conn->error);

        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function WriteToDB(string $table, array $data) : bool{
        $columns = implode(',' , array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $stmt = $this->conn->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        if (!$stmt) return false;
        $types = str_repeat('s', count($data)); // alle strings, pas aan als nodig
        $stmt->bind_param($types, ...array_values($data));

        return $stmt->execute();
    }

    public function close(): void {
        $this->conn->close();
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function readFromTable(){
        
    }

}


?>