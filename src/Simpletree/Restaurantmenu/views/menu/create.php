<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Simpletree\Restaurantmenu\models\MenuInfo $model
 */

$this->title = 'Create Menu Info';
$this->params['breadcrumbs'][] = ['label' => 'Menu Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-info-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
