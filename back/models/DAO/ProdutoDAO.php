<?php

namespace app\models\DAO;
use app\models\DAO\DAOModel;
use Yii;

class ProdutoDAO extends DAOModel
{   
    /**
    * @return string the name of the table associated with this ActiveRecord class.
    */
    public static function tableName()
    {
       return 'produto';
    }
    
    public static function dbFields()
    {
        return [
            'id' => 'pk',
            'nome' => 'string',
            'preco' => 'double',
            'quantidade' => 'int'
        ];
    }
}