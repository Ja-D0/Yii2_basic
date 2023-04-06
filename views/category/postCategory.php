<?php

use yii\helpers\Html;

?>
<?php
foreach ($post->models as $model) {
    echo $this->render('shortView', [
        'model' => $model
    ]);
}
?>