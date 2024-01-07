<?php

namespace app\controllers\api;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\Controller;
use yii\web\Response;
use yii\rbac\PhpManager;
use Firebase\JWT\JWT;
use yii\filters\auth\HttpBearerAuth;
use Yii;

class AuthController extends Controller
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
                'except' => ['index', 'weather'], // Deixe a ação de login desprotegida
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    }
    
    public function actionIndex()
    {
        $mUser = new User();
        if (Yii::$app->request->isPost){
            $post = ['User' => Yii::$app->request->post()];
            $mUser->load($post);
            
            if (empty($mUser->password)) {
                return ['error' => "Password can't be empty"];
            }
            
            $mUser->scenario = "login";
            $identity = User::findOne(['username' => $mUser->username]);
            
            // logar o usuário
            if (!empty($identity)){
                $pass_hash = $identity->password;
                $valid = Yii::$app->getSecurity()->validatePassword($mUser->password, $pass_hash);
                
                if($valid && Yii::$app->user->login($identity)){
                    $token = $this->generateJwtToken($mUser);
                    return ['token' => $token];
                } else {
                    return ['error' => 'Wrong password'];
                }
            } else {
                return ['error' => 'Wrong username/password'];
            }
            // $post = ['LivroModel' => Yii::$app->request->post()];
            // $mLivros->load($post);

            // if ($id = $mLivros->create()) {
            //     Yii::$app->response->statusCode = 201; // Created
            //     $mLivros->id = $id;
            //     $mLivros->data_cadastro = date('Y-m-d');
            //     return $mLivros;
            // } else {
            //     Yii::$app->response->statusCode = 200; // Unprocessable Entity
            //     return ['error' => $mLivros->getErrors()];
            // }
        } else {
            return ['error' => 'Você precisa fazer uma requisição post para logar'];
        }
    }
    
    public function actionCheck()
    {
        return [];
    }
    
    public function actionWeather()
    {
        $ch = curl_init('https://api.hgbrasil.com/weather?key=SUA-CHAVE&user_ip=remote');

        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        $resposta = json_decode(curl_exec($ch), true);
        
        curl_close($ch);
        
        return $resposta;
    }

    private function generateJwtToken($user)
    {
        $key = 'rTrNoA1fYpsJRorFzdm-0eWMZmCHH_xO'; // Substitua com uma chave secreta forte
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // Token expira em 1 hora

        $tokenData = [
            'iat'  => $issuedAt,    // Timestamp do token de emissão
            'exp'  => $expirationTime, // Timestamp de expiração
            'data' => [             // Dados do usuário
                'id' => $user->id, // Id do usuário
                'username' => $user->username
            ]
        ];

        return JWT::encode($tokenData, $key, 'HS256');
    }
}
