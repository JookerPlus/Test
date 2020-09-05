<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;


class RestController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {

        if ($action->id == 'book-update') {
            $this->enableCsrfValidation = false;
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionGetBookList()
    {
        $books = Book::find()->with('author')->all();
        $book_list = [];
        if ($books) {
            foreach ($books as $book) {
                $book_list[] = ['book_name' => $book->name, 'author_name' => $book->author->name];
            }
        }
        return $book_list;
    }

    public function actionGetBooksByAuthor($author)
    {
        if ($author = Author::find()->where(['name' => $author])->one())
        {
            return $books = $author->books;
        }
        return [];
    }

    public function actionGetBook($id)
    {
        $book = $this->findModel($id);
        return $book;
    }

    public function actionBookUpdate($id)
    {
        $book = $this->findModel($id);

        if ($book)
        {
            $book->setAttributes(Yii::$app->request->post());
            if ($book->save())
            {
                return true;
            }
        }
        return false;
    }

    public function actionBookDelete($id)
    {
        $book = $this->findModel($id);
        if ($book)
        {
            $book->delete();
            return true;
        }
        return false;
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}