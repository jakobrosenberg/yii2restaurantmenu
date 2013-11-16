<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Simpletree\Restaurantmenu\models\MenuInfoSearch $searchModel
 */

$this->title = 'Menu Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-info-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemOptions' => ['class' => 'item'],
		'itemView' => function ($model, $key, $index, $widget) {
			return Html::a('['.Html::encode($model->url).']', ['view', 'url' => $model->url]);
		},
	]); ?>

</div>


<?php //foreach (\Simpletree\Restaurantmenu\models\MenuInfo::find()
//                   ->languageOrder()
//                   ->subQuery()
//                   ->groupBy('id_menu')
//                   ->all() AS $m)
//               print_r($m->attributes)?>