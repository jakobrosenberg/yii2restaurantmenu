<?php

namespace Simpletree\Restaurantmenu\models;

use common\models\ActiveRecord;

/**
 * This is the model class for table "menu_item".
 *
 * @property integer $id
 * @property integer $id_menu
 * @property integer $item_number
 *
 * @property Menu $idMenu
 * @property MenuItemInfo[] $menuItemInfos
 */
class MenuItem extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'menu_item';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['id_menu, item_number', 'integer']
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdMenu()
	{
		return $this->hasOne(Menu::className(), ['id' => 'id_menu']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getMenuItemInfos()
	{
		return $this->hasMany(MenuItemInfo::className(), ['id_menu_item' => 'id'])
            ->orderBy(['FIELD(language, "da", "en", "de") DESC, language'=>1]);
	}

    public function getMenuItemInfo()
    {
        return $this->hasOne(MenuItemInfo::className(), ['id_menu_item' => 'id'])
            ->orderBy(['FIELD(language, "en", "de") DESC, language'=>1]);
    }
}
