<?php

namespace Simpletree\Restaurantmenu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Simpletree\Restaurantmenu\models\Menu;

/**
 * MenuSearch represents the model behind the search form about Menu.
 */
class MenuSearch extends Model
{
	public $id;
	public $id_site;
	public $active;

	public function rules()
	{
		return [
			['id', 'integer'],
			['id_site', 'safe'],
			['active', 'boolean'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'id_site' => 'Id Site',
			'active' => 'Active',
		];
	}

	public function search($params)
	{
		$query = Menu::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'id_site', true);
		$this->addCondition($query, 'active');
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
