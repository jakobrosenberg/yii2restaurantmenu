<?php

namespace Simpletree\Restaurantmenu\models;

use yii\db\ActiveQuery;
use yii\db\Query;
use yii\db\sqlite\QueryBuilder;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $url
 * @property string $id_site
 * @property boolean $active
 *
 * @property MenuInfo[] $menuInfos
 * @property MenuItem[] $menuItems
 */
class Menu extends \yii\db\ActiveRecord
{
    public $language = null;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'menu';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
            [['id_site'], 'required'],
            [['active'], 'boolean'],
            [['url'], 'string', 'max' => 32],
            [['id_site'], 'string', 'max' => 128]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
            'url' => 'Url',
            'id_site' => 'Id Site',
			'active' => 'Active',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
    public function getMenuInfo()
    {
        $order = '"da", "en", "de"';
        $link = ['id_menu' => 'id'];

        $command = $this->hasOne(MenuInfo::className(), $link)
            ->orderBy(['FIELD (language, ' . $order . ') ASC, language'=>1])
            ->createCommand();

        return $this->hasOne(MenuInfo::className(), $link)
            ->from(['('.$command->sql.') AS t'])
            ->addParams($command->params)
            ->groupBy('id_menu');
    }

	public function getMenuInfos()
	{
        return $this->hasMany(MenuInfo::className(), ['id_menu' => 'id'])
            ->orderBy(['FIELD (language, "da", "en", "de") ASC, language'=>1]);
    }



	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getMenuItems()
	{
		return $this->hasMany(MenuItem::className(), ['id_menu' => 'id']);
	}

    public function getGroupedMenuItems()
    {
        $order = '"da", "en", "de"';
        $this->menuItems->orderBy(['FIELD (language, ' . $order . ') ASC, language'=>1]);
        $command = $this->menuItems->createCommand();

        return $this->hasMany(MenuInfo::className(), ['id_menu' => 'id'])
            ->from(['('.$command->sql.') AS t'])
            ->addParams($command->params)
            ->groupBy('id_menu');
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if(!$this->id_site){
            $this->id_site = \Yii::$app->params['siteId'];
        }
        return true;

    }
}
