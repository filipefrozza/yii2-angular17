<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="produto">
    <h2><?= Html::encode($model->nome) ?></h2>

    <p>
        Preço: <?= HtmlPurifier::process($model->preco) ?> <br>
        Quantidade: <?= HtmlPurifier::process($model->quantidade) ?>
    </p>
    <p><?= Html::a('Editar', ['produto/editar-produto', 'id' => $model->id], ['class' => 'btn btn-lg btn-success']) ?></p>
    <p><?= Html::a('Remover', ['produto/remover-produto', 'id' => $model->id], ['class' => 'btn btn-lg btn-success']) ?></p>
</div>