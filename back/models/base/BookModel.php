<?php
/*
     Título;
     Descrição;
     Autor;
     Número de Páginas;
     Data de Cadastro;
*/

namespace app\models\base;
use app\models\DefaultModel;
use app\models\DAO\BookDAO;

class BookModel extends DefaultModel
{
    public $id;
    public $title;
    public $description;
    public $author;
    public $pages;
    public $created_at;
    
    public function __construct(){
        parent::__construct();
        $this->dao = new BookDAO();
        $this->daoClass = BookDAO::class;
    }
    
    public function attributeLabels()
    {
        return [
            'id' => '',
            'title' => 'Title',
            'description' => 'Description',
            'author' => 'Author',
            'pages' => 'Pages',
            'created_at' => 'Created at'
        ];
        
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['title', 'description', 'author', 'pages'];
        $scenarios['edit'] = ['id', 'title', 'description', 'author', 'pages'];
        return $scenarios;
    }
    
    public function rules()
    {
        return [
            [['title', 'description', 'author', 'pages'], 'required', 'on' => 'criar'],
            [['id', 'title', 'description', 'author', 'pages'], 'required', 'on' => 'editar']
        ];
    }
    
    public function fields()
    {
        return [
            'id',
            'title',
            'description',
            'author',
            'pages',
            'created_at'
        ];
    }
}