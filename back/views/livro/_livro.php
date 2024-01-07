<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="livro">
    <h2><?= Html::encode($model->titulo) ?></h2>

    <p>
        <?= HtmlPurifier::process($model->descricao) ?>
    </p>
    <p>
        Autor: <?= HtmlPurifier::process($model->autor) ?><br>
        Nº Páginas: <?= HtmlPurifier::process($model->paginas) ?>
    </p>
    <p><?= Html::a('Editar', ['livro/editar', 'id' => $model->id], ['class' => 'btn btn-lg btn-success']) ?></p>
    <p><?= Html::a('Remover', ['livro/remover', 'id' => $model->id], ['class' => 'btn btn-lg btn-success']) ?></p>
</div>