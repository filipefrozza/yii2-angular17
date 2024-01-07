<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
//use app\models\base\LivroModel;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    public $modelClass;
    
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [],
                'rules' => [
                    [
                        'roles' => ['admin'],
                        'allow' => true,
                    ]
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays index page.
     *
     * @return Response|string
     */
    public function actionIndex()
    {   
        $model = new $this->modelClass();
        
        return $this->render('index', ["model" => $model]);
    }
    
    
    /**
     * Displays criar page.
     *
     * @return Response|string
     */
    public function actionCriar()
    {   
        $model = new $this->modelClass();
        $model->scenario = "criar";
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->create()) {
            $this->redirect(['index']);
        }
        
        return $this->render('criar', ["model" => $model]);
    }
    
    
    
    /**
     * Displays editar page.
     *
     * @return Response|string
     */
    public function actionEditar($id)
    {   
        $model = new $this->modelClass();
        $model->scenario = "editar";
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save()) {
            $this->redirect(['index']);
        } else {
            $row = $model->getOne($id);
            $model->setAttributes($row->toArray());
        }
        
        return $this->render('editar', ["model" => $model]);
    }
    
    /**
     * Remove o registro e manda de volta para a listagem.
     *
     * @return Response|string
     */
    public function actionRemover($id = null)
    {   
        if(!empty($id)){
            $model = new $this->modelClass();
            
            $row = $model->getOne($id);
            
            $row->delete();
        } 
        
        $this->redirect(['index']);
    }
}
