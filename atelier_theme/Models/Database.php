<?php

class Database {
    private string $host = 'db5001988950.hosting-data.io';
    private string $dbName = 'dbs1623575';
    private string $charset = 'utf8mb4';
    private string $username = 'dbu782740';
    private string $password = 'P6kgZoW8cJckujXLQqKY';

    private PDO $pdo;
    private PDOStatement $statement;
    
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}",
                $this->username,
                $this->password,
                [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query(string $sql, array $values = []): Database
    {
        foreach ($values as $key => $value) {
            if ($key === 'body' || $key === 'answer') continue;
            if (is_string($value)) $values[$key] = htmlspecialchars($value);
        }

        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($values);
        return $this;
    }

    public function count(): int
    {
        return $this->statement->rowCount();
    }

    public function results(): array
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first(): array
    {
        return $this->results()[0];
    }

    public function getError()
    {
        return $this->pdo->errorInfo();
    }
}