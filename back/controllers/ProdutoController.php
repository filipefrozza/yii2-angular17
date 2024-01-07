<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\base\ProdutoModel;
use yii\filters\VerbFilter;

class ProdutoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
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
     * Displays index_produtos page.
     *
     * @return Response|string
     */
    public function actionIndexProdutos()
    {   
        $mProduto = new ProdutoModel();
        
        return $this->render('index_produtos', ["mProduto" => $mProduto]);
    }
    
    
    /**
     * Displays criar_produto page.
     *
     * @return Response|string
     */
    public function actionCriarProduto()
    {   
        $mProduto = new ProdutoModel();
        $mProduto->scenario = "criar-produto";
        if ($mProduto->load(Yii::$app->request->post()) && $mProduto->criar()) {
            return $this->refresh();
        }
        
        return $this->render('criar_produto', ["mProduto" => $mProduto]);
    }
    
    
    
    /**
     * Displays editar_produto page.
     *
     * @return Response|string
     */
    public function actionEditarProduto($id)
    {   
        $mProduto = new ProdutoModel();
        $mProduto->scenario = "editar-produto";
        $post = Yii::$app->request->post();
        if ($mProduto->load($post) && $mProduto->salvar()) {
            $this->redirect(['index-produtos']);
        } else {
            $dProduto = $mProduto->getOne($id);
            $mProduto->setAttributes($dProduto->toArray());
        }
        
        return $this->render('editar_produto', ["mProduto" => $mProduto]);
    }
    
    /**
     * Displays removar_produto page.
     *
     * @return Response|string
     */
    public function actionRemoverProduto($id = null)
    {   
        if(!empty($id)){
            $mProduto = new ProdutoModel();
            
            $dProduto = $mProduto->getOne($id);
            
            $dProduto->delete();
        } 
        
        $this->redirect(['index-produtos']);
        // if ($mProduto->load(Yii::$app->request->post()) && $mProduto->criar()) {
        //     return $this->refresh();
        // }
    }
}
