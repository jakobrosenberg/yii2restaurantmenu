<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var yii\base\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Simpletree\Restaurantmenu\models\MenuItemInfoSearch $searchModel
 */

$this->title = 'Menu Item Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-item-info-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create MenuItemInfo', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemOptions' => ['class' => 'item'],
		'itemView' => function ($model, $key, $index, $widget) {
			return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
		},
	]); ?>

</div>
