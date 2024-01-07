<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\base\LivroModel;
use app\controllers\DefaultController;

class LivroController extends DefaultController
{   
    public function init()
    {
        parent::init();
        $this->modelClass = LivroModel::class;
    }
}
