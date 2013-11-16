<?php

namespace Simpletree\Restaurantmenu\controllers;

use common\models\Site;
use Simpletree\Restaurantmenu\models\Menu;
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
 * MenuController implements the CRUD actions for Menu model.
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
	 * Lists all Menu models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$query = Menu::find()->own();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Menu model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($url, $language = null)
	{
        $model = $this->findModel($url);
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
	 * Creates a new Menu model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($language = null)
	{
        $language = $this->getLanguage();

		$model = new Menu;
        $model->createNewInfo();
        $model->info->language = $language;



		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['view', 'url' => $model->url]);
		}else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }

	}

	/**
	 * Updates an existing Menu model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($url)
	{
		$model = $this->findModel($url);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Menu model.
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
	 * Finds the Menu model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Menu the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($url)
	{
		if (($model = Menu::findByUrl($url)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}

    private function getLanguage()
    {
        if(isset($_REQUEST['language'])){
            $language = $_REQUEST['language'];
        }else
            $language = \Yii::$app->site->languageArray[0];
        return $language;
    }
}
