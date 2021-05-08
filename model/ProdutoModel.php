<?php
class ProdutoModel{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getAll()
    {
        $link = $this->db->openDbConnection();

        $result = $link->query('SELECT * FROM produtos ORDER BY idproduto');
        
        $return = array();
        
        $this->db->closeDbConnection($link);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $row['caracteristica'] = $this->getCaracteristicaByProdutoId($row['idproduto']);
            $row['categoria'] = $this->getCategoriaByProdutoId($row['idproduto'], $link);
            $return[] = $row;
        }
        
		return $return;
    }

    public function getByName($nome)
    {
        $link = $this->db->openDbConnection();

        $result = $link->query('SELECT * FROM produtos where nome like \'%'.$nome.'%\' ORDER BY idproduto');
        
        $return = array();
        
        $this->db->closeDbConnection($link);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $row['caracteristica'] = $this->getCaracteristicaByProdutoId($row['idproduto']);
            $row['categoria'] = $this->getCategoriaByProdutoId($row['idproduto'], $link);
            $return[] = $row;
        }
        
		return $return;
    }

    public function getByCat($id)
    {
        $link = $this->db->openDbConnection();

        $result = $link->query('SELECT p.* 
                                FROM produtos p
                                WHERE EXISTS (SELECT 1 FROM produto_categorias where idproduto = p.idproduto and idcategoria = '.$id.')
                                ORDER BY p.idproduto');
        
        $return = array();
        
        $this->db->closeDbConnection($link);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $row['caracteristica'] = $this->getCaracteristicaByProdutoId($row['idproduto']);
            $row['categoria'] = $this->getCategoriaByProdutoId($row['idproduto'], $link);
            $return[] = $row;
        }
        
		return $return;
    }


    public function getByCac($id)
    {
        $link = $this->db->openDbConnection();

        $result = $link->query('SELECT p.* 
                                FROM produtos p
                                WHERE EXISTS (SELECT 1 FROM produto_caracteristicas where idproduto = p.idproduto and idcaracteristica = '.$id.')
                                ORDER BY p.idproduto');
        
        $return = array();
        
        $this->db->closeDbConnection($link);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $row['caracteristica'] = $this->getCaracteristicaByProdutoId($row['idproduto']);
            $row['categoria'] = $this->getCategoriaByProdutoId($row['idproduto'], $link);
            $return[] = $row;
        }
        
		return $return;
    }

    public function getProdutoById($id)
    {
        $link = $this->db->openDbConnection();

        $query = 'SELECT * FROM produtos WHERE idproduto=:id';
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->db->closeDbConnection($link);

        $row[0]['caracteristica'] = $this->getCaracteristicaByProdutoId($row[0]['idproduto']);
        $row[0]['categoria'] = $this->getCategoriaByProdutoId($row[0]['idproduto']);
        return $row;
    }

    private function getCategoriaByProdutoId($id)
    {
        $link = $this->db->openDbConnection();
        $query = 'SELECT c.* 
                  FROM produto_categorias cat
                    join categorias c on c.idcategoria = cat.idcategoria 
                  WHERE idproduto=:id';
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $return = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $return[] = $row;
        }
        $this->db->closeDbConnection($link);
        return $return;
    }

    private function getCaracteristicaByProdutoId($id)
    {
        $link = $this->db->openDbConnection();
        $query = 'SELECT c.* 
                  FROM produto_caracteristicas cac
                    join caracteristicas c on c.idcaracteristica = cac.idcaracteristica 
                  WHERE idproduto=:id';
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $return = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $return[] = $row;
        }
        $this->db->closeDbConnection($link);
        return $return;
    }
	
    public function insert()
    {
        $link = $this->db->openDbConnection();
        
        $imagename = $_FILES['imagem']['name'];
        $imagetype = $_FILES['imagem']['type'];
        $imageerror = $_FILES['imagem']['error'];
        $imagetemp = $_FILES['imagem']['tmp_name'];


        
        $imagePath = $_SERVER['DOCUMENT_ROOT']."/blue_service/asset/images/";
        $imageUrl = $_SERVER['HTTP_HOST']."/blue_service/asset/images/$imagename";
        move_uploaded_file($imagetemp, $imagePath . $imagename);

        $query = 'INSERT INTO produtos (nome, preco, imagem) VALUES (:nome, :preco, :imagem)';
        $statement = $link->prepare($query);
        $statement->bindValue(':nome', $_POST['nome'], PDO::PARAM_STR);
        $statement->bindValue(':preco', $_POST['preco'], PDO::PARAM_STR);
        $statement->bindValue(':imagem', $imageUrl, PDO::PARAM_STR);
        $statement->execute();
        $id = $link->lastInsertId();
        foreach($_POST['caracteristica'] as $cac){
            $query = 'INSERT INTO produto_caracteristicas (idproduto, idcaracteristica) VALUES (:id, :idcac)';
            $statement = $link->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':idcac', $cac, PDO::PARAM_INT);
            $statement->execute();
        }

        foreach($_POST['categoria'] as $cat){
            $query = 'INSERT INTO produto_categorias (idproduto, idcategoria) VALUES (:id, :idcat)';
            $statement = $link->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':idcat', $cat, PDO::PARAM_INT);
            $statement->execute();
        }
        $this->db->closeDbConnection($link);
    }

    public function update($id)
    {
        $link = $this->db->openDbConnection();
        $imagename = $_FILES['imagem']['name'];
        $imagetype = $_FILES['imagem']['type'];
        $imageerror = $_FILES['imagem']['error'];
        $imagetemp = $_FILES['imagem']['tmp_name'];


        
        $imagePath = $_SERVER['DOCUMENT_ROOT']."/blue_service/asset/images/";
        $imageUrl = $_SERVER['HTTP_HOST']."/blue_service/asset/images/$imagename";
        move_uploaded_file($imagetemp, $imagePath . $imagename);

        $query = "UPDATE produtos SET nome = :nome, preco = :preco, imagem = :imagem WHERE idproduto = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':nome', $_POST['nome'], PDO::PARAM_STR);
        $statement->bindValue(':preco', $_POST['preco'], PDO::PARAM_STR);
        $statement->bindValue(':imagem', $imageUrl, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $id = $link->lastInsertId();
        $query = "DELETE FROM produto_caracteristicas WHERE idproduto = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $query = "DELETE FROM produto_categorias WHERE idproduto = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        foreach($_POST['caracteristica'] as $cac){
            $query = 'INSERT INTO produto_caracteristicas (idproduto, idcaracteristica) VALUES (:id, :idcac)';
            $statement = $link->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':idcac', $cac, PDO::PARAM_INT);
            $statement->execute();
        }

        foreach($_POST['categoria'] as $cat){
            $query = 'INSERT INTO produto_categorias (idproduto, idcategoria) VALUES (:id, :idcat)';
            $statement = $link->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':idcat', $cat, PDO::PARAM_INT);
            $statement->execute();
        }
        $this->db->closeDbConnection($link);
    }

    public function delete($id)
    {
        $link = $this->db->openDbConnection();

        $query = "DELETE FROM produtos WHERE idproduto = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }
}