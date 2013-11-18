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
 * @property MenuInfo $info
 * @property MenuItems[] $items
 */
class Menu extends \yii\db\ActiveRecord
{
    private $_info;

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
            [['url'], 'required'],
            [['url'], 'homecookedUniqueValidator'],
//            [['id_site','url'], 'unique', 'attributeName'=>['id_site', 'url']],
            [['active'], 'boolean'],
            [['url'], 'string', 'max' => 32],
            [['id_site'], 'string', 'max' => 128],
		];
	}

    public function homecookedUniqueValidator()
    {
        if($this->isNewRecord && self::findByUrl($this->url))
            $this->addError('url', 'url must be unique');
    }

    public static function findByUrl($url, $id_site = false)
    {
        $id_site = $id_site ? $id_site : \Yii::$app->site->id_site;
        return self::find(['id_site'=>$id_site, 'url'=>$url]);
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
    public function getInfo()
    {
        $order = '"da", "en", "de"';
        $link = ['id_menu' => 'id'];

        $command = $this->hasOne(MenuInfo::className(), $link)
            ->orderBy(['FIELD (language, ' . $order . ') ASC, language'=>1])
            ->createCommand();

        $info = $this->hasOne(MenuInfo::className(), $link)
            ->from(['('.$command->sql.') AS t'])
            ->addParams($command->params)
            ->groupBy('id_menu');
        return $info;
    }

    public function createNewInfo()
    {
        $this->populateRelation('info', new MenuInfo);
    }

	public function getInfos()
	{
        return $this->hasMany(MenuInfo::className(), ['id_menu' => 'id'])
            ->orderBy(['FIELD (language, "da", "en", "de") ASC, language'=>1]);
    }



	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getItems()
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
        if(!$this->url){
            $lowerCasecName = str_to_lower($this->info->name);
            $this->url = preg_replace('/[^a-z0-9]/', '', $lowerCasecName);
        }
        if(!$this->info->validate()){
            return false;
        }
        if(!$this->id_site){
            $this->id_site = \Yii::$app->params['siteId'];
        }
        return true;
    }

    public function afterSave($insert)
    {
        foreach($this->populatedRelations AS $relation){
            $relation->id_menu = $this->id;
            $relation->save();
        }
        parent::afterSave($insert);
    }

    /**
     * @param $query ActiveQuery
     */
    public static function own($query)
    {
        $query->andWhere(['id_site'=>\Yii::$app->site->id_site]);
    }
}
