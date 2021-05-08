<?php
require_once "lib/Database.php";
require_once "model/CategoriaModel.php";
require_once "model/CaracteristicaModel.php";
require_once "model/ProdutoModel.php";
class Publico{
    protected $model = '';

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function index()
    {
        $db = new Database();
        $categoria = new CategoriaModel($db);
        $produto = new ProdutoModel($db);
        $caracteristica = new CaracteristicaModel($db);
        
        $categorias = $categoria->getAll();
        if(!empty($_GET['buscaCat'])){
            $produtos = $produto->getByCat($_GET['buscaCat']);
        }elseif(!empty($_GET['buscaCac'])){
            $produtos = $produto->getByCac($_GET['buscaCac']);
        }elseif(!empty($_GET['busca'])){
            $produtos = $produto->getByName($_GET['busca']);
        }else{
            $produtos = $produto->getAll();
        }

        $caracteristicas = $caracteristica->getAll();
        require 'view/publico/list.php';
    }


    public function addCarrinho(){
        $this->model->addCarrinho();
        $this->index();
    }

    public function finalizarCompra(){
        $this->model->finalizarCompra();
        $this->index();
    }

    public function getPedidos(){
        $pedido = $this->model->getPedidos();
        require 'view/publico/pedidos.php';
    }


}