<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/**
 * @var yii\base\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Simpletree\Restaurantmenu\models\MenuItemSearch $searchModel
 */

$this->title = 'Menu Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-item-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create MenuItem', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'id_menu',
			'item_number',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

    <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                },
        ]); ?>

</div>
