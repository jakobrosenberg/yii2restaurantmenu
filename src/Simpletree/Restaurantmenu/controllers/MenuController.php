<?php

namespace Simpletree\Restaurantmenu\controllers;

use Simpletree\Restaurantmenu\models\MenuInfo;
use Simpletree\Restaurantmenu\models\MenuInfoSearch;
use Simpletree\Restaurantmenu\models\MenuItem;
use Simpletree\Restaurantmenu\models\MenuItemInfo;
use Simpletree\Restaurantmenu\models\MenuItemInfoSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\VerbFilter;

/**
 * MenuController implements the CRUD actions for MenuInfo model.
 */
class MenuController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all MenuInfo models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new MenuInfoSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single MenuInfo model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id, $language = null)
	{
        $model = $this->findModel($id);
        if($language === null){
            $language = \Yii::$app->site->languageArray[0];
        }


//        $items = MenuItem::find()->all();
//        foreach($items AS $item)
//            print_r($item->MenuItemInfo->attributes);
//        $model = $this->findModel($id);
        $query = MenuItem::find();

//        $query = MenuItemInfo::find()->with('MenuItem')
//            ->orderByField('language', ['en','de','da'])
////            ->addOrderBy('menu_item.id')
//            ->nestQuery()
//            ->groupBy('id_menu_item')
//            ->nestQuery();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		return $this->render('view', [
			'model' => $model,
            'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Creates a new MenuInfo model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new MenuInfo;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing MenuInfo model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing MenuInfo model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the MenuInfo model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return MenuInfo the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = MenuInfo::find($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
