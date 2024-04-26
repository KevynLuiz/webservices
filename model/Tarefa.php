<?php

class Tarefa
{
    private $conn;
    private $table_name = 'tarefas';

    public $id_Tarefa;
    public $titulo;
    public $descricao;
    public $id_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' SET titulo = :titulo, descricao = :descricao, id_usuario = :id_usuario';
        $stmt = $this->conn->prepare($query);
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':id_usuario', $this->id_usuario);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll()
    {
        $query = 'SELECT * FROM ' . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getUserById($id_Tarefa)
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id_Tarefa = :id_Tarefa';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_Tarefa', $id_Tarefa);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->titulo = $row['titulo'];
            $this->descricao = $row['descricao'];
            return $row;
        }
        return [];
    }


    // Atualizar usuário
    public function update()
    {
        $query = 'UPDATE ' . $this->table_name . ' SET titulo = :titulo, descricao = :descricao, id_usuario = :id_usuario WHERE id_Tarefa = :id_Tarefa ';
        $stmt = $this->conn->prepare($query);
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id_Tarefa = htmlspecialchars(strip_tags($this->id_Tarefa));
        $this->id_Tarefa = htmlspecialchars(strip_tags($this->id_usuario));
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':id_Tarefa', $this->id_Tarefa);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Deletar usuário
    public function remove()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id_Tarefa = :id_Tarefa';
        $stmt = $this->conn->prepare($query);

        $this->id_Tarefa = (int) $this->id_Tarefa;
        $stmt->bindParam(':id_Tarefa', $this->id_Tarefa);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
