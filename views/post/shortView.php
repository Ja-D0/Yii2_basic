<?php

use yii\helpers\Html;

?>
    <h1><?= $model->title ?></h1>

    <div class="meta">
        <p>Автор: <?= $model->author->nickname ?> Дата публикации: <?= $model->publish_date ?>
            Категория: <?= $model->category->title ?></p>
    </div>

    <div class="tags">
        Тэги: <?php foreach($model->getTagPost()->all() as $post) : ?>
            <?= $post->getTag()->one()->title ?>
        <?php endforeach; ?>
    </div>

    <div class="content">
        <?= $model->anons ?>
    </div>

<?= Html::a('Читать далее', ['//post/view', 'id' => $model->id], ['class' => 'btn btn-success']) ?><?php
