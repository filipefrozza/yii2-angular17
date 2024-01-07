<?php

namespace app\models\base;
use yii\base\Model;
use app\models\DAO\ProdutoDAO;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

class ProdutoModel extends Model
{
    public $id;
    public $nome;
    public $preco;
    public $quantidade;
    private $dao;
    
    public function __construct(){
        parent::__construct();
        $this->dao = new ProdutoDAO();
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
            'query' => ProdutoDAO::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_produto',
        ]);
    }
    
    public function criar()
    {
        $this->dao = new ProdutoDAO();
        $this->dao->nome = $this->nome;
        $this->dao->preco = $this->preco;
        $this->dao->quantidade = $this->quantidade;
        $r = $this->dao->save();
        $this->dao = new ProdutoDAO();
        return $r;
    }
    
    public function salvar()
    {
        $sProduto = $this->dao->findOne($this->id);
        $sProduto->nome = $this->nome;
        $sProduto->preco = $this->preco;
        $sProduto->quantidade = $this->quantidade;
        $r = $sProduto->save();
        return $r;
    }
    
    public function attributeLabels()
    {
        return [
            'id' => '',
            'nome' => 'Nome do produto',
            'preco' => 'Preço',
            'quantidade' => 'Quantidade'
        ];
        
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['criar-produto'] = ['nome', 'preco', 'quantidade'];
        $scenarios['editar-produto'] = ['id', 'nome', 'preco', 'quantidade'];
        return $scenarios;
    }
    
    public function rules()
    {
        return [
            [['nome', 'preco', 'quantidade'], 'required', 'on' => 'criar_produto'],
            [['id', 'nome', 'preco', 'quantidade'], 'required', 'on' => 'editar_produto']
        ];
    }
    
    public function fields()
    {
        return [
            'id',
            'nome',
            'preco',
            'quantidade'
        ];
    }
}