<?php

use yii\helpers\Html;

/**
 * Created by Jakob
 * Date: 16-11-13
 * Time: 23:23
 * @var yii\web\View $this
 */ ?>


<?php $this->beginContent('@app/views/layouts/main.php')?>

<?= Html::beginForm(Yii::$app->requestedRoute, 'get', ['id'=>'user-language-form']) ?>
<?php $language = isset($_REQUEST['language']) ? $_REQUEST['language'] : Yii::$app->site->languageArray[0] ?>
<?= Html::dropDownList('language', $language, \common\components\LanguageHelper::longArray(Yii::$app->site->languageArray)) ?>
<?= Html::submitButton() ?>
<?= Html::endForm() ?>

<?php $this->registerJs('

    var form = $( "#user-language-form" );
    form.children( "button" ).hide();
    form.children( "select" ).change(function() {
        form.submit()
    });
') ?>



<?= $content ?>

<?php $this->endContent(); ?>
