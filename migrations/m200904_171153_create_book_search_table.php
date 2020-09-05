<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_search}}`.
 */
class m200904_171153_create_book_search_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_search}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_search}}');
    }
}
