<?php

use app\models\Category;
use app\models\Tags;
use app\models\User;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \app\models\Post $model */

$this->title = 'Создать публикацию';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'authors' => $authors,
        'tags' => $tags
    ]) ?>

</div>
