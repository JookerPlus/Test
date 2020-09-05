<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h4>Тестовое задание</h4>
        <a href="<?= Url::toRoute('book/'); ?>">Книги</a><br>
        <a href="<?= Url::toRoute('author/'); ?>">Авторы</a><br>
    </div>
</div>
