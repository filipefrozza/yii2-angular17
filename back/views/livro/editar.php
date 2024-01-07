<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\base\ProdutoModel $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Editar Livro';
$this->params['breadcrumbs'][] = ['label' => 'Livros', 'url' => ['livro/index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="site-livro-editar">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor preencha todos os campos:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'produto',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'titulo')->textInput(['autofocus' => true]) ?>
            
            <?= $form->field($model, 'descricao')->textInput(['autofocus' => true]) ?>
            
            <?= $form->field($model, 'autor')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'paginas')->textInput() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary', 'name' => 'salvar-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
