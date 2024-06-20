<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    public $accessToken;
    public $rememberMe = true;

    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Get the name of the database table associated with the model.
     *
     * @return string
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authKey = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $u = new User();
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            // Decodifica e verifica a assinatura do token
            $decoded = JWT::decode($token, new Key('rTrNoA1fYpsJRorFzdm-0eWMZmCHH_xO', 'HS256'));
            $identity = self::findByUsername($decoded->data->username);
            return $identity;
        } catch (\Exception $e) {
            // A assinatura não é válida ou ocorreu algum erro na decodificação
            return null;
        }
        // return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    
    /**
     * Returns the rules for validation.
     *
     * @return array the validation rules
     */
    public function rules()

    {

        return [

            [['username', 'password'], 'required'], // required
            [['accessToken', 'admin'], 'safe'] // not required

        ];

    }
    
    /**
     * Return the database fields as an associative array.
     *
     * @return array
     */
    public static function dbFields()
    {
        return [
            'id' => 'pk',
            'username' => 'string',
            'password' => 'string',
            'authKey' => 'string',
            'access_token' => 'string',
            'admin' => 'tinyint'
        ];
    }
}
