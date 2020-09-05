<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_search}}`.
 */
class m200904_171200_create_author_search_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_search}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author_search}}');
    }
}
