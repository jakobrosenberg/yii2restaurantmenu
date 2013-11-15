<?php

namespace Simpletree\Restaurantmenu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Simpletree\Restaurantmenu\models\MenuItem;

/**
 * MenuItemSearch represents the model behind the search form about MenuItem.
 */
class MenuItemSearch extends Model
{
	public $id;
	public $id_menu;
	public $item_number;

	public function rules()
	{
		return [
			['id, id_menu, item_number', 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'id_menu' => 'Id Menu',
			'item_number' => 'Item Number',
		];
	}

	public function search($params)
	{
		$query = MenuItem::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'id_menu');
		$this->addCondition($query, 'item_number');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
