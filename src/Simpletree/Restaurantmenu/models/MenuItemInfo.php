<?php

namespace Simpletree\Restaurantmenu\models;


/**
 * This is the model class for table "menu_item_info".
 *
 * @property integer $id
 * @property integer $id_menu_item
 * @property string $language
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $currency
 * @property string $price_comment
 *
 * @property MenuItem $idMenuItem
 */
class MenuItemInfo extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'menu_item_info';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_menu_item', 'price'], 'integer'],
			[['language'], 'string', 'max' => 5],
			[['name', 'description', 'price_comment'], 'string', 'max' => 255],
			[['currency'], 'string', 'max' => 3]
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getMenuItem()
	{
		return $this->hasOne(MenuItem::className(), ['id' => 'id_menu_item']);
	}
//
//    public function orderMe()
//    {
//        $this->orderBy('language');
//    }
}
