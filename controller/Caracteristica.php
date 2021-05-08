<?php 
class Caracteristica{
    protected $model = '';

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $caracteristica = $this->model->getAll();
        require 'view/caracteristica/list.php';
    }

    public function detail($id)
    {
        $caracteristica = $this->model->getCaracteristicaById($id);
        require 'view/caracteristica/detail.php';
    }

    public function create()
    {
        if ($_POST) {
            $this->model->insert();
            header("Location: ".__PATHURL."/index.php/caracteristica");
        } else {
            require 'view/caracteristica/form.php';
        }
    }

    public function edit($id)
    {
        if ($_POST) {
            $this->model->update($id);
            header("Location: ".__PATHURL."/index.php/caracteristica");
        } else {
            $caracteristica = $this->model->getCaracteristicaById($id);
            require 'view/caracteristica/form.php';
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->model->delete($id);
            header("Location: ".__PATHURL."/index.php/caracteristica");
        }
    }
}