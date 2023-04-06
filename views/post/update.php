<?php

use app\models\Tags;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \app\models\Post $model */

$this->title = 'Изменить публикацю ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'authors' => $authors,
        'tags' => $tags
    ]) ?>

</div>
