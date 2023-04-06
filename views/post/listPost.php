<?php

use yii\helpers\Html;

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-8 post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($dataProvider->models as $model) {
        echo $this->render('shortView', [
            'model' => $model
        ]);
    }
    ?>

</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <h1>Категории</h1>
    <ul>
        <?php
        foreach ($categories->models as $category) {
            echo $this->render('//category/shortViewCategory', [
                'model' => $category
            ]);
        }
        ?>
    </ul>
</div>

