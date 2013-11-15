<?php

namespace Simpletree\Restaurantmenu\models;

/**
 * This is the model class for table "menu_info".
 *
 * @property integer $id
 * @property integer $id_menu
 * @property string $language
 * @property string $name
 * @property string $description
 *
 * @property Menu $idMenu
 */
class MenuInfo extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'menu_info';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
            [['id_menu', 'language', 'name'], 'required'],
            [['id_menu'], 'integer'],
            [['description'], 'string'],
            [['language'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 255]
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdMenu()
	{
		return $this->hasOne(Menu::className(), ['id' => 'id_menu']);
	}

    /**
     * @param \yii\db\ActiveQuery $query
     */
    public static function subQuery($query)
    {
        $subQuery = clone($query);
        $command = $subQuery->createCommand();
        $query->from(['('.$command->sql.') AS t'])
            ->addParams($command->params);
    }

    /**
     * @param \yii\db\ActiveQuery $query
     */
    public static function languageOrder($query)
    {
        $order = '"da", "en", "de"';
        $query->orderBy(['FIELD (language, ' . $order . ') ASC, language'=>1]);
    }


}
