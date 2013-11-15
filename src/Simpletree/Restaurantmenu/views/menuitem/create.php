<?php

use yii\helpers\Html;

/**
 * @var yii\base\View $this
 * @var Simpletree\Restaurantmenu\models\MenuItem $model
 */

$this->title = 'Create Menu Item';
$this->params['breadcrumbs'][] = ['label' => 'Menu Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-item-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
