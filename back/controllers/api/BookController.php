<?php

namespace app\controllers\api;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\base\BookModel;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\auth\HttpBearerAuth;
use Yii;

class BookController extends Controller
{   
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
            'authenticator' => [
                'class' => HttpBearerAuth::class,
                'except' => ['options'], // Deixe a ação de login desprotegida
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    }
    
    public function actionOptions()
    {
        return [];
    }
    
    public function actionIndex()
    {
        $mBooks = new BookModel();
        if (Yii::$app->request->isPost){
            $mBooks->scenario = "create";
            $post = ['BookModel' => Yii::$app->request->post()];
            $mBooks->load($post);

            if ($id = $mBooks->create()) {
                Yii::$app->response->statusCode = 201; // Created
                $mBooks->id = $id;
                $mBooks->created_at = date('Y-m-d');
                return $mBooks;
            } else {
                Yii::$app->response->statusCode = 200; // Unprocessable Entity
                return ['error' => $mBooks->getErrors()];
            }
        } else {
            $bBooks = $mBooks->getAll();
            return $bBooks;
        }
    }

    public function actionById($id)
    {
        $mBooks = new BookModel();
        $bBook = $mBooks->getOne($id);
        if (Yii::$app->request->isDelete) {
            if (!empty($bBook)){
                $bBook->delete();
                return '{"deleted": true}';
            } else {
                return '{"deleted": false, "error": "Not found on database"}';
            }
        } else if (Yii::$app->request->isPut) {
            $mBooks->scenario = "editar";
            $post = ['BookModel' => Yii::$app->request->post()];
            $mBooks->load($post);
            
            if ($mBooks->save()) {
                Yii::$app->response->statusCode = 201; // Saved
                return $mBooks;
            } else {
                Yii::$app->response->statusCode = 200;
                return ['error' => $mBooks->getErrors()];
            }
        } else if (empty($bBook)) {
            return '{}';
        } else {
            return $bBook;
        }
    }
}
