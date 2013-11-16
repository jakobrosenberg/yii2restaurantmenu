<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LanguageHelper;

/**
 * @var yii\web\View $this
 * @var Simpletree\Restaurantmenu\models\MenuInfo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

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




<div class="menu-form">

	<?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model->info, 'language')->dropDownList(LanguageHelper::longArray(Yii::$app->site->languageArray)) ?>

        <?= $form->field($model, 'url')->textInput() ?>

        <?= $form->field($model->info, 'language')->textInput(['maxlength' => 5, 'value'=>$language]) ?>

		<?= $form->field($model->info, 'name')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model->info, 'description')->textarea(['rows' => 6]) ?>

		<div class="form-group">
            <?php $update = $model->info->isNewRecord? 'Add translation' : 'Update' ?>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
