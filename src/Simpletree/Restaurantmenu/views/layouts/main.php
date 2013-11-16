<?php
/**
 * Created by Jakob
 * Date: 16-11-13
 * Time: 23:23
 * @var yii\web\View $this
 */ ?>


<?php $this->beginContent('@app/views/layouts/main')?>

<?php $this->endContent(); ?>

<?= $this->render('@app/views/layouts/main', ['content'=>$content2]) ?>
