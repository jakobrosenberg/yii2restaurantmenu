<?php

namespace Simpletree\Restaurantmenu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Simpletree\Restaurantmenu\models\MenuInfo;

/**
 * MenuInfoSearch represents the model behind the search form about MenuInfo.
 */
class MenuInfoSearch extends Model
{
	public $id;
	public $id_menu;
	public $language;
	public $name;
	public $description;

	public function rules()
	{
		return [
			['id, id_menu', 'integer'],
			['language, name, description', 'safe'],
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
			'language' => 'Language',
			'name' => 'Name',
			'description' => 'Description',
		];
	}

	public function search($params)
	{
		$query = MenuInfo::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'id_menu');
		$this->addCondition($query, 'language', true);
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'description', true);
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
