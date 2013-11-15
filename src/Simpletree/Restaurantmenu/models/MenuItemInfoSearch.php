<?php

namespace Simpletree\Restaurantmenu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Simpletree\Restaurantmenu\models\MenuItemInfo;

/**
 * MenuItemInfoSearch represents the model behind the search form about MenuItemInfo.
 */
class MenuItemInfoSearch extends Model
{
	public $id;
	public $id_menu_item;
	public $language;
	public $name;
	public $description;
	public $price;
	public $currency;
	public $price_comment;

	public function rules()
	{
		return [
			['id, id_menu_item, price', 'integer'],
			['language, name, description, currency, price_comment', 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'id_menu_item' => 'Id Menu Item',
			'language' => 'Language',
			'name' => 'Name',
			'description' => 'Description',
			'price' => 'Price',
			'currency' => 'Currency',
			'price_comment' => 'Price Comment',
		];
	}

	public function search($params)
	{
		$query = MenuItemInfo::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'id_menu_item');
		$this->addCondition($query, 'language', true);
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'description', true);
		$this->addCondition($query, 'price');
		$this->addCondition($query, 'currency', true);
		$this->addCondition($query, 'price_comment', true);
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
