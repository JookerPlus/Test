<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m200904_164235_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-book-author_id',
            'book',
            'author_id'
        );

        $this->addForeignKey(
            'fk-book-author_id',
            'book',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-book-author_id',
            'book'
        );

        $this->dropIndex(
            'idx-book-author_id',
            'book'
        );

        $this->dropTable('{{%book}}');
    }
}
