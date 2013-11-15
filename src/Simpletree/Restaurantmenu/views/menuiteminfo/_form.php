<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var Simpletree\Restaurantmenu\models\MenuItemInfo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-item-info-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_menu_item')->textInput() ?>

		<?= $form->field($model, 'price')->textInput() ?>

		<?= $form->field($model, 'language')->textInput(['maxlength' => 5]) ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'price_comment')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'currency')->textInput(['maxlength' => 3]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
