<?php
/*
     Título;
     Descrição;
     Autor;
     Número de Páginas;
     Data de Cadastro;
*/

namespace app\models;
use yii\base\Model;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

class DefaultModel extends Model
{
    protected $dao;
    protected $daoClass;
    
    public function __construct(){
        parent::__construct();
    }
    
    public function getAll()
    {
        return $this->dao->find()->all();
    }
    
    public function getOne($id)
    {
        return $this->dao->findOne($id);
    }
    
    public function listAll()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->daoClass::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_livro',
        ]);
    }
    
    public function create()
    {
        $row = new $this->daoClass();
        $fields = $this->fields();
        foreach ($fields as $field) {
            if ($field == 'id' || empty($this->$field)) continue;
            $row->$field = $this->$field;
        }
        if($row->save()){
            return $row->getDb()->getLastInsertID();
        } else {
            return false;
        }
    }
    
    public function save()
    {
        $row = $this->dao->findOne($this->id);
        $fields = $this->fields();
        foreach ($fields as $field) {
            if ($field == 'id' || empty($this->$field)) continue;
            $row->$field = $this->$field;
        }
        return $row->save();
    }
}