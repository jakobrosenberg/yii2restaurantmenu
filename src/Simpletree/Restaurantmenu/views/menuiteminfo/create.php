<?php

use yii\helpers\Html;

/**
 * @var yii\base\View $this
 * @var Simpletree\Restaurantmenu\models\MenuItemInfo $model
 */

$this->title = 'Create Menu Item Info';
$this->params['breadcrumbs'][] = ['label' => 'Menu Item Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-item-info-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
