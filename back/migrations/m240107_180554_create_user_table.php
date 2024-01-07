<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m240107_180554_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->text()->notNull(),
            'password' => $this->text()->notNull(),
            'authKey' => $this->text(),
            'access_token' => $this->text(),
            'admin' => $this->boolean()
        ]);
        
        $this->insert('{{%user}}', [
           'username' => 'admin',
           'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
           'admin' => true
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
