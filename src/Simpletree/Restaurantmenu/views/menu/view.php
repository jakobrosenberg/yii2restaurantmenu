<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var Simpletree\Restaurantmenu\models\MenuInfo $model
 */
$this->title = $model->info->name;
$this->params['breadcrumbs'][] = ['label' => 'Menu Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="menu-info-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'url' => $model->url], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'url' => $model->url], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model->info,
		'attributes' => [
			'id',
			'id_menu',
			'language',
			'name',
			'description:ntext',
		],
	]); ?>


    <div class="center">
        <?php $dataProvider->pagination->pageSize=4 ?>
        <?php echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_view', ['model'=>$model->menuItemInfo]);
                    },

            ]) ?>
        </div>
</div>
