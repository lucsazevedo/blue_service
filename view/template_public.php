<?php
?><!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo ?></title>
    <link href="<?= __PATHURL?>/asset/css/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <a href="<?= __PATHURL?>/index.php/produto" class="btn btn-info">Painel Administrador</a>
        <?= $isi ?>
    </div>
    <script src="<?= __PATHURL?>/asset/js/jquery.min.js"></script>
    <script src="<?= __PATHURL?>/asset/css/js/bootstrap.min.js"></script>
  </body>
</html>