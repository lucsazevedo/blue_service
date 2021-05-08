<!-- view/Produto/list.php -->
<?php
    $form_action = __PATHURL."/index.php/publico/addCarrinho";
    $titulo = 'Produtos';
?>

<?php ob_start() ?>
	<br>
    <center><h1>Todos os Produtos</h1></center>
	<br>
    <div class="row">
    <div class="col-sm-9">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Filtrar por Categoria: </a>
        <div>
          <div class="navbar-nav">
            <?php
                foreach($categorias as $cat){
                    ?>
                    <a class="nav-item nav-link <?= !empty($_GET['buscaCat']) && $_GET['buscaCat'] == $cat['idcategoria'] ? 'active': ''; ?>" href="?buscaCat=<?=$cat['idcategoria']?>"><?=$cat['descricao']?></a>
                    <?php
                }
            ?>
          </div>
        </div>
      </nav>
    </div>
    <div class="col-sm-3">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name="busca" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
      </form> 
  </div>
  <div class="row">
    <div class="col-sm-9">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Filtrar por Caracteristica: </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <?php
                foreach($caracteristicas as $cac){
            ?>
                    <a class="nav-item nav-link <?= !empty( $_GET['buscaCac']) && $_GET['buscaCac'] == $cac['idcaracteristica'] ? 'active': ''; ?>" href="?buscaCac=<?=$cac['idcaracteristica']?>"><?=$cac['descricao']?></a>
                    <?php
                }
            ?>
          </div>
        </div>
      </nav>
    </div>
    <div class="col-sm-3">
    <button type="button" class="btn btn-primary btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">Carrinho(<?= !empty($_SESSION['carrinho']) ? array_sum(array_column($_SESSION['carrinho'], 'qtd')) : '' ?>)</button>
  </div>
  </div>
	<div class="row">
        <?php foreach ($produtos as $row): ?>
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="http://<?=$row['imagem']?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['nome']?></h5>
                        <p class="card-text">Caracteristicas: <?= implode(', ', array_map(function ($entry) {  return $entry['descricao'];}, $row['caracteristica'])); ?></p>
                        <p class="card-text">Categorias: <?= implode(', ', array_map(function ($entry) {  return $entry['descricao'];}, $row['categoria'])); ?></p>
                        <h3>Preço: R$<?= number_format((int)$row['preco'],2,',','.') ?></h3>
                        <form action="<?= $form_action ?>" method="post">
                          <div class="form-row align-items-center">
                            <div class="col-auto">
                              <div class="input-group mb-2">
                                <input type="hidden" name="idproduto" value="<?= $row['idproduto']; ?>">
                                <input type="hidden" name="preco" value="<?= $row['preco'] ?>">
                                <input type="hidden" name="nome" value="<?= $row['nome'] ?>">
                                <input type="number" name="qtd" value="1" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                
                                <div class="input-group-prepend">
                                  <button class="btn btn-secondary" type="submit">Comprar</button>
                                </div>
                              </div>
                            </div>

                          </div>
                      </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
	</div>
 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Meu Carrinho</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Produto</th>
              <th scope="col">Qtd.</th>
              <th scope="col">Valor Und.</th>
              <th scope="col">Valor Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $contador = 1;
              foreach($_SESSION['carrinho'] as $carrinho){
                ?><tr>
                <th scope="row"><?=$contador?></th>
                <td><?=$carrinho['nome']?></td>
                <td><?=$carrinho['qtd']?></td>
                <td><?= number_format((int)$carrinho['preco'],2,',','.')?></td>
                <td><?= number_format((int)$carrinho['preco'] * $carrinho['qtd'],2,',','.')?></td>
              </tr><?php
              $contador++;
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <a href="/blue_service/index.php/publico/finalizarcompra" class="btn btn-primary">Concluir Compra</a>
      </div>
    </div>
  </div>
</div>



   <?php $isi = ob_get_clean() ?>

<?php include 'view/template_public.php' ?>