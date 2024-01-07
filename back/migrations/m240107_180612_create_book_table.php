<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m240107_180612_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'author' => $this->text()->notNull(),
            'pages' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
