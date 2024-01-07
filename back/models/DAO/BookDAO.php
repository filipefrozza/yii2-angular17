<?php

/*
     Título;
     Descrição;
     Autor;
     Número de Páginas;
     Data de Cadastro;
*/

namespace app\models\DAO;
use app\models\DAO\DAOModel;
use Yii;

class BookDAO extends DAOModel
{   
    /**
    * @return string the name of the table associated with this ActiveRecord class.
    */
    public static function tableName()
    {
       return 'book';
    }
    
    public static function dbFields()
    {
        return [
            'id' => 'pk',
            'title' => 'string',
            'description' => 'string',
            'author' => 'string',
            'pages' => 'int',
            'created_at' => 'date default now()'
        ];
    }
}