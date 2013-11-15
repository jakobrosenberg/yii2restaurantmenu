<?php

use yii\helpers\Html;

/**
 * @var yii\base\View $this
 * @var Simpletree\Restaurantmenu\models\MenuItemInfo $model
 */

$this->title = 'Update Menu Item Info: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menu Item Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-item-info-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
