<?php

namespace app\models\DAO;
use yii\db\ActiveRecord;
use Yii;

class DAOModel extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public function __construct(){
        parent::__construct();
        // CREATE TABLE
        // if (Yii::$app->db->getTableSchema($this->tableName(), true) === null) {
        //     Yii::$app->db->createCommand()->createTable($this->tableName(), $this->dbFields())->execute();
        // }
    }
}