<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var Simpletree\Restaurantmenu\models\MenuInfo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-info-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_menu')->textInput() ?>

		<?= $form->field($model, 'language')->textInput(['maxlength' => 5]) ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
