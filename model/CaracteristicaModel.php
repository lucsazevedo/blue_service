<?php
class CaracteristicaModel{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getAll()
    {
        $link = $this->db->openDbConnection();

        $result = $link->query('SELECT * FROM caracteristicas ORDER BY idcaracteristica');

        $return = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $return[] = $row;
        }
        
        $this->db->closeDbConnection($link);

		return $return;
    }

    public function getCaracteristicaById($id)
    {
        $link = $this->db->openDbConnection();

        $query = 'SELECT * FROM caracteristicas WHERE idcaracteristica=:id';
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->db->closeDbConnection($link);

        return $row;
    }
	
    public function insert()
    {
        $link = $this->db->openDbConnection();

        $query = 'INSERT INTO caracteristicas (descricao) VALUES (:descricao)';
        $statement = $link->prepare($query);
        $statement->bindValue(':descricao', $_POST['descricao'], PDO::PARAM_STR);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }

    public function update($id)
    {
        $link = $this->db->openDbConnection();

        $query = "UPDATE caracteristicas SET descricao = :descricao WHERE idcaracteristica = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':descricao', $_POST['descricao'], PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }

    public function delete($id)
    {
        $link = $this->db->openDbConnection();

        $query = "DELETE FROM caracteristicas WHERE idcaracteristica = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }
}