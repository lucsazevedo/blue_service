<?php 
require_once "lib/Database.php";
require_once "model/CategoriaModel.php";
require_once "model/CaracteristicaModel.php";
class Produto{
    protected $model = '';

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $produto = $this->model->getAll();
        require 'view/produto/list.php';
    }

    public function detail($id)
    {
        $produto = $this->model->getProdutoById($id);
        require 'view/produto/detail.php';
    }

    public function create()
    {
        if ($_POST) {
            $this->model->insert();
            header("Location: ".__PATHURL."/index.php/produto");
        } else {
            $db = new Database();
            $categoria = new CategoriaModel($db);
            $caracteristica = new CaracteristicaModel($db);
            $categorias = $categoria->getAll(); 
            $caracteristicas = $caracteristica->getAll(); 
            require 'view/produto/form.php';
        }
    }

    public function edit($id)
    {
        if ($_POST) {
            $this->model->update($id);
            header("Location: ".__PATHURL."/index.php/produto");
        } else {
            $produto = $this->model->getProdutoById($id);
            require 'view/produto/form.php';
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->model->delete($id);
            header("Location: ".__PATHURL."/index.php/produto");
        }
    }
}