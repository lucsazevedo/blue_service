<!-- view/Pedido/list.php -->
<?php $titulo = 'Pedido';
?>

<?php ob_start() ?>
	<br>
    <center><h1>Pedidos</h1></center>
	<br>
	<div class="table-responsive"> 
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Data pedido</th>
            <th>Total</th>
        </tr>
        <?php foreach ($pedido as $row): ?>
        <tr>
            <td><?= $row['idpedido'] ?></td>
            <td><?= date( "d/m/Y H:i", strtotime($row['data_pedido']) ) ?></td>
            <td><?= $row['total'] ?></td>
         </tr>
        <?php endforeach ?>
    </table>
	</div>
    <br>
<?php $isi = ob_get_clean() ?>

<?php include 'view/template.php' ?>