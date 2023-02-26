<?php

class DBConnect
{
    protected $conn;

    public function __construct()
    {
        $host = "mysql";
        $username = "root";
        $password = "root";
        $dbname = "todolist";

        try {
            $pdo = new PDO("$host:dbname=$dbname;host=$host", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        $this->conn = $pdo;
    }

    function createTableTodoList()
    {
        $sql = "CREATE TABLE IF NOT EXISTS todolist (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            work_name VARCHAR(255) NOT NULL,
            starting_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            ending_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            status int(3) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        )";

        try {
            $this->conn->exec($sql);
            echo "Created Success!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function showAllTodoList()
    {
        try {
            $table_name = "todolist";

            $sql = "SELECT * , CASE
            WHEN status = 1 THEN 'Planning'
            WHEN status = 2 THEN 'Doing'
            ELSE 'Complete'
            END as status  FROM $table_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function showTodoListById($id)
    {
        try {
            $table_name = "todolist";
            $sql = "SELECT * , CASE
            WHEN status = 1 THEN 'Planning'
            WHEN status = 2 THEN 'Doing'
            ELSE 'Complete'
            END as status  FROM $table_name WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function addTodoList($workName, $startDate, $endDate, $status)
    {
        try {
            $sql = "INSERT INTO todolist (work_name, starting_date, ending_date, status)
                    VALUES (:work_name, :starting_date, :ending_date, :status)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':work_name', $workName);
            $stmt->bindParam(':starting_date', $startDate);
            $stmt->bindParam(':ending_date', $endDate);
            $stmt->bindParam(':status', $status);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->conn  = null;
    }

    function editTodoList($id, $workName, $startingDate, $endingDate, $status)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE todolist SET work_name = :workName, starting_date = :startingDate, ending_date = :endingDate, status = :status WHERE id = :id");

            $stmt->bindParam(':workName', $workName);
            $stmt->bindParam(':startingDate', $startingDate);
            $stmt->bindParam(':endingDate', $endingDate);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    function deleteTodoList($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM todolist WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
        $this->conn = null;
    }
}
