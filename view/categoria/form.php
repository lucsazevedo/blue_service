<!-- view/categoria/form.php -->
<?php
$request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
$uri = explode('/', $request);

// Set form action
if ($uri[1] === 'edit') {
    $titulo = 'Editar Categoria';
    $form_action = __PATHURL."/index.php/categoria/edit?id=" . $_GET['id'];
} else {
    $titulo = 'Cadastrar Categoria';
    $form_action = __PATHURL."/index.php/categoria/create";
}

$valDescricao = isset($categoria['descricao']) ? $categoria['descricao'] : '';
$valId = isset($categoria['id']) ? $categoria['id'] : '';
?>

<?php ob_start() ?>
    <h1><?= $titulo ?></h1>

    <form action="<?= $form_action ?>" method="post">
        <?php if ($valId): ?>
            <input type="hidden" name="id" value="<?= $valId ?>">
        <?php endif ?>

        <div class="form-group">
            <label for="nama">Descrição</label>
            <input name="descricao" type="text" value="<?= $valDescricao ?>" class="form-control" id="descricao">
        </div>

        <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
<?php $isi = ob_get_clean() ?>

<?php include 'view/template.php' ?>