<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            //$pass_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $identity = User::findOne(['username' => $model->username]);
            
            // logar o usuário
            if (!empty($identity)){
                $pass_hash = $identity->password;
                $valid = Yii::$app->getSecurity()->validatePassword($model->password, $pass_hash);
                
                if($valid && Yii::$app->user->login($identity)){
                    return $this->goHome();
                }
            } else {
                $model = new User();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Register action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        $post = Yii::$app->request->post();
        if (!empty($post)) {
            $post['User']['admin'] = false;
            $post['User']['password'] = Yii::$app->getSecurity()->generatePasswordHash($post['User']['password']);
            $model->setAttributes($post['User']);
            $validado = $model->validate();
            if ($model->save()){
                return $this->redirect(['login']);
            } else {
                return $this->refresh();
            }
        }
        return $this->render('register', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    /**
     * Displays crud page.
     *
     * @return Response|string
     */
    public function actionProdutosIndexProdutos()
    {
        return $this->render('produtos\index_produtos', []);
    }
}
