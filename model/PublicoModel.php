<?php
class PublicoModel{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function addCarrinho(){
        $idproduto = $_POST['idproduto'];
        $preco = $_POST['preco'];
        $qtd = $_POST['qtd'];
        $nome = $_POST['nome'];
        if(!empty($_SESSION['carrinho'][$idproduto]['qtd'])){
            $_SESSION['carrinho'][$idproduto]['qtd'] += $qtd; 
        }else{
            $_SESSION['carrinho'][$idproduto] = ['preco' => $preco, 'qtd' => $qtd, 'nome'=>$nome];
        }
    }

    public function finalizarCompra(){
        $link = $this->db->openDbConnection();
        $query = 'INSERT INTO pedidos (total) VALUES (:total)';
        $statement = $link->prepare($query);
        $statement->bindValue(':total', array_sum(array_column($_SESSION['carrinho'], 'preco')), PDO::PARAM_STR);
        $statement->execute();
        $id = $link->lastInsertId();
        foreach($_SESSION['carrinho'] as $key=>$carrinho){
            $query = 'INSERT INTO pedidos_itens (idproduto, quantidade, valor_item, idpedido) VALUES (:idproduto, :quantidade, :valor_item, :idpedido)';
            $statement = $link->prepare($query);
            $statement->bindValue(':idproduto', $key, PDO::PARAM_INT);
            $statement->bindValue(':quantidade', $carrinho['qtd'], PDO::PARAM_INT);
            $statement->bindValue(':valor_item', $carrinho['preco'], PDO::PARAM_STR);
            $statement->bindValue(':idpedido', $id, PDO::PARAM_INT);
            $statement->execute();
        }

        $this->db->closeDbConnection($link);
        $_SESSION['carrinho'] = [];
    }

    public function getPedidos(){
        $link = $this->db->openDbConnection();
        $result = $link->query('SELECT * FROM pedidos ORDER BY idpedido');
        $return = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $return[] = $row;
        }
        
        $this->db->closeDbConnection($link);

		return $return;
    }
}