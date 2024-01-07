<?php

/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = 'Cadastro de Produto';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Cadastro de Produto!</h1>

        <p class="lead">Cadastre seus produtos aqui.</p>

        <!-- <p><a class="btn btn-lg btn-success" href="#">Criar novo produto</a></p> -->
        <p><?= Html::a('Criar novo Produto', ['produto/criar-produto'], ['class' => 'btn btn-lg btn-success']) ?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <?=$mProduto->listAll()?>
        </div>
    </div>
</div>
