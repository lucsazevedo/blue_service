<!-- view/Produto/list.php -->
<?php $titulo = 'Produto';
?>

<?php ob_start() ?>
	<br>
    <center><h1>Produtos</h1></center>
	<br>
	<div class="table-responsive"> 
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Imagem</th>
            <th>Categorias</th>
            <th>Caracteristicas</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php foreach ($produto as $row): ?>
        <tr>
            <td><?= $row['idproduto'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['preco'] ?></td>
            <?php 
                if($row['imagem']){
                    ?>
                        <td><img src="http://<?= $row['imagem'] ?>" class="img-thumbnail"></td>
                    <?php
                }else{
                    ?>
                    <td></td>
                    <?php
                }
            ?>
            <td><?= implode(', ', array_map(function ($entry) {  return $entry['descricao'];}, $row['categoria'])); ?></td>
            <td><?= implode(', ', array_map(function ($entry) {  return $entry['descricao'];}, $row['caracteristica'])); ?></td>
            <td><a href="<?= __PATHURL?>/index.php/Produto/edit?id=<?= $row['idproduto'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>
            <td><a href="<?= __PATHURL?>/index.php/Produto/delete?id=<?= $row['idproduto']?>" onclick="return confirm('Tem certeza que deseja Excluir essa produto?')" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-trash"></span> Excluir</a></td>
        </tr>
        <?php endforeach ?>
    </table>
	</div>
    <br>
    <a href="<?= __PATHURL?>/index.php/Produto/create" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Novo</a>
<?php $isi = ob_get_clean() ?>

<?php include 'view/template.php' ?>