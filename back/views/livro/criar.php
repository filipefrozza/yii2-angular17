<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Criar Livro';
$this->params['breadcrumbs'][] = ['label' => 'Livros', 'url' => ['livro/index']];
$this->params['breadcrumbs'][] = 'Criar';
?>
<div class="site-livro-criar">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor preencha todos os campos:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'livro',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'titulo')->textInput(['autofocus' => true]) ?>
            
            <?= $form->field($model, 'descricao')->textInput(['autofocus' => true]) ?>
            
            <?= $form->field($model, 'autor')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'paginas')->textInput() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Criar', ['class' => 'btn btn-primary', 'name' => 'Criar-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
