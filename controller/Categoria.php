<?php 
class Categoria{
    protected $model = '';

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $categoria = $this->model->getAll();
        require 'view/categoria/list.php';
    }

    public function detail($id)
    {
        $categoria = $this->model->getCategoriaById($id);
        require 'view/categoria/detail.php';
    }

    public function create()
    {
        if ($_POST) {
            $this->model->insert();
            header("Location: ".__PATHURL."/index.php/categoria");
        } else {
            require 'view/categoria/form.php';
        }
    }

    public function edit($id)
    {
        if ($_POST) {
            $this->model->update($id);
            header("Location: ".__PATHURL."/index.php/categoria");
        } else {
            $categoria = $this->model->getCategoriaById($id);
            require 'view/categoria/form.php';
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->model->delete($id);
            header("Location: ".__PATHURL."/index.php/categoria");
        }
    }
}