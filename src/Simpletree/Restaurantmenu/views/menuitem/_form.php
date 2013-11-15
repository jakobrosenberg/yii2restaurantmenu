<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var Simpletree\Restaurantmenu\models\MenuItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-item-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_menu')->textInput() ?>

		<?= $form->field($model, 'item_number')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
