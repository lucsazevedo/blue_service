<!-- view/Categoria/list.php -->
<?php $titulo = 'Categoria';
?>

<?php ob_start() ?>
	<br>
    <center><h1>Categorias</h1></center>
	<br>
	<div class="table-responsive"> 
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php foreach ($categoria as $row): ?>
        <tr>
            <td><?= $row['idcategoria'] ?></td>
            <td><?= $row['descricao'] ?></td>
            <td><a href="<?= __PATHURL?>/index.php/Categoria/edit?id=<?= $row['idcategoria'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>
            <td><a href="<?= __PATHURL?>/index.php/Categoria/delete?id=<?= $row['idcategoria']?>" onclick="return confirm('Tem certeza que deseja Excluir essa categoria?')" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-trash"></span> Excluir</a></td>
        </tr>
        <?php endforeach ?>
    </table>
	</div>
    <br>
    <a href="<?= __PATHURL?>/index.php/Categoria/create" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Novo</a>
<?php $isi = ob_get_clean() ?>

<?php include 'view/template.php' ?>