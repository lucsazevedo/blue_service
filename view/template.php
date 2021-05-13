<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo ?></title>
    <link href="<?= __PATHURL?>/asset/css/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Teste - Lucas Azevedo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="<?= __PATHURL?>/index.php/produto">Produtos</a>
        <a class="nav-link" href="<?= __PATHURL?>/index.php/caracteristica">Caracteristicas</a>
        <a class="nav-link" href="<?= __PATHURL?>/index.php/categoria">Categorias</a>
        <a class="nav-link" href="<?= __PATHURL?>/index.php/pedidos">Pedidos</a>
      </div>
    </div>
  </div>
</nav>

    <div class="container">
        <?= $isi ?>
    </div>
    <script src="<?= __PATHURL?>/asset/js/jquery.min.js"></script>
    <script src="<?= __PATHURL?>/asset/css/js/bootstrap.min.js"></script>
    
<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
          var forms = document.getElementsByClassName('needs-validation');
          var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {

                    var failed = false;

                    var arrCat =[];
                    var arrAllCat = [];
                    $('input[id^=cat').each(function() {
                      arrAllCat.push($(this));
                      if(!$(this).is(':checked')){
                          arrCat.push($(this));
                      }
                    });

                    if (arrCat.length == arrAllCat.length) {
                        arrCat.forEach(element =>{
                          $(element).attr('required', true);
                        });
                        failed = true;
                    }else {
                      arrCat.forEach(element =>{
                          $(element).attr('required', false);
                        });
                    }

                    var arrCac =[];
                    var arrAllCac = [];
                    $('input[id^=cac').each(function() {
                      arrAllCac.push($(this));
                      if(!$(this).is(':checked')){
                          arrCac.push($(this));
                      }
                    });

                    if (arrCac.length == arrAllCac.length) {
                        arrCac.forEach(element =>{
                          $(element).attr('required', true);
                        });
                        failed = true;
                    }else {
                      arrCat.forEach(element =>{
                          $(element).attr('required', false);
                        });
                    }

                    if (form.checkValidity() === false) {
                        failed = true;
                    }

                    if (failed == true) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

  </body>
</html>