<?php

/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = 'Livros';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Gerenciamento de livros</h1>

        <!-- <p><a class="btn btn-lg btn-success" href="#">Criar novo produto</a></p> -->
        <p><?= Html::a('Criar novo Livro', ['livro/criar'], ['class' => 'btn btn-lg btn-success']) ?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <?=$model->listAll()?>
        </div>
    </div>
</div>
