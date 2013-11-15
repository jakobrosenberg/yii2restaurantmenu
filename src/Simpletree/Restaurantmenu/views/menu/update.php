<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Simpletree\Restaurantmenu\models\MenuInfo $model
 */

$this->title = 'Update Menu Info: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menu Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-info-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
