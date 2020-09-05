<?php

namespace app\models;

use http\Message;
use Yii;
use yii\validators\UniqueValidator;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string|null $name
 * @property int $author_id
 *
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'required', 'message' => 'Выберите автора'],
            [['author_id'], 'integer'],

            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'targetAttribute' => 'name', 'message' => 'Книга с таким названием уже существует'],

            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    public function getAuthorName()
    {
        $author = $this->author->name;

        return $author ? $author : '';
    }
}
