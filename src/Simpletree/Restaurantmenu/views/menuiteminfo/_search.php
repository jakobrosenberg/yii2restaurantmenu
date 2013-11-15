<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var Simpletree\Restaurantmenu\models\MenuItemInfoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-item-info-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'id_menu_item') ?>

		<?= $form->field($model, 'language') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'description') ?>

		<?php // echo $form->field($model, 'price') ?>

		<?php // echo $form->field($model, 'currency') ?>

		<?php // echo $form->field($model, 'price_comment') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
