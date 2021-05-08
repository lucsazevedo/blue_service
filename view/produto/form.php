<!-- view/produto/form.php -->
<?php
$request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
$uri = explode('/', $request);

// Set form action
if ($uri[1] === 'edit') {
    $titulo = 'Editar Produto';
    $form_action = __PATHURL."/index.php/produto/edit?id=" . $_GET['id'];
} else {
    $titulo = 'Cadastrar Produto';
    $form_action = __PATHURL."/index.php/produto/create";
}

$valNome = isset($produto['nome']) ? $produto['nome'] : '';
$valPreco = isset($produto['preco']) ? $produto['preco'] : '';
$valImagem = isset($produto['imagem']) ? $produto['imagem'] : '';
$valId = isset($produto['id']) ? $produto['id'] : '';
?>

<?php ob_start() ?>
    <h1><?= $titulo ?></h1>

    <form enctype="multipart/form-data" action="<?= $form_action ?>" method="post" id="form">
        <?php if ($valId): ?>
            <input type="hidden" name="id" value="<?= $valId ?>">
        <?php endif ?>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="nome">Nome</label>
            <div class="col-sm-10">
                <input name="nome" type="text" value="<?= $valNome ?>" class="form-control" id="nome" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="preco">Preço</label>
            <div class="col-sm-10">
                <input name="preco" type="number" min="1" step="any" value="<?= $valPreco ?>" class="form-control" id="preco" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="imagem">Imagem</label>
            <div class="col-sm-10">
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                <input name="imagem" type="file" accept="image/*" value="<?= $valImagem ?>" class="form-control" id="imagem">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="categoria">Categorias</label>
            <div class="col-sm-10">
                <?php
                    foreach($categorias as $cat){
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" class="categoria" name="categoria[]" id="cat<?=$cat['idcategoria']?>" value="<?=$cat['idcategoria']?> ">
                            <label class="form-check-label" for="cat<?=$cat['idcategoria']?>"><?=$cat['descricao']?></label>
                        </div>
                    <?php
                    }
                ?>
                <div class="invalid-feedback">Choose at least one.</div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="caracteristica">Caracteristicas</label>
            <div class="col-sm-10">
                <?php
                    foreach($caracteristicas as $cac){
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="caracteristica[]" id="cac<?=$cac['idcaracteristica']?>" value="<?=$cac['idcaracteristica']?>">
                            <label class="form-check-label" for="cac<?=$cac['idcaracteristica']?>"><?=$cat['descricao']?></label>
                        </div>
                    <?php
                    }
                ?>
            </div>
        </div>
        
        <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
<?php $isi = ob_get_clean() ?>

<?php include 'view/template.php' ?>