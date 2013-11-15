<?php

use yii\db\Schema;

class m131101_182854_create_menu_table extends \yii\db\Migration
{
	public function safeUp()
	{
        $this->dropTables();
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';


        //MENU
        $this->createTable('menu', [
                'id' => 'pk',
                'url' => 'varchar(32)',
                'id_site' => 'string(128) NOT NULL',
                'active' => Schema::TYPE_BOOLEAN
            ], $tableOptions);
        $this->createIndex('site', 'menu', 'id_site');
        $this->createIndex('url', 'menu', 'id_site,url', 1);


        //MENU_INFO
        $this->createTable('menu_info', [
                'id' => 'pk',
                'id_menu' => 'int NOT NULL',
                'language' => 'string(5) NOT NULL',
                'name' => 'string NOT NULL',
                'description' => 'text'
            ], $tableOptions);
        $this->createIndex('language', 'menu_info', 'language');
        $this->createIndex('menu_and_language', 'menu_info', 'id_menu,language', true);
        $this->addForeignKey('menu_to_menu_info', 'menu_info', 'id_menu', 'menu', 'id', 'cascade', 'cascade');


        //MENU_ITEM
        $this->createTable('menu_item', [
                'id' => 'pk',
                'id_menu' => 'int(8)',
                'item_number' => 'int(4)',
            ], $tableOptions);
        $this->addForeignKey('menu_to_menu_item', 'menu_item', 'id_menu', 'menu', 'id', 'cascade', 'cascade');


        //MENU_ITEM_INFO
        $name = 'menu_item_info';
        $this->createTable($name, [
                'id' => 'pk',
                'id_menu_item' => 'int',
                'language' => 'string(5)',
                'name' => 'string',
                'description' => 'string',
                'price' => 'int(7)',
                'currency' => 'string(3)',
                'price_comment' => 'string',
            ], $tableOptions);
        $this->createIndex('id_menu_item_AND_language', $name, 'id_menu_item,language', true);
        $this->addForeignKey('menu_item_to_menu_item_info', $name, 'id_menu_item', 'menu_item', 'id', 'cascade');


        $this->seed();
	}

	public function safeDown()
	{
        $this->dropTables();
		return true;
	}

    public function dropTables()
    {
        foreach(array( 'menu_item_info', 'menu_item', 'menu_info', 'menu') AS $table){
            $table = $this->db->quoteTableName($table);
            $this->db->createCommand()->setSql('DROP TABLE IF EXISTS '.$table)->execute();
            echo "dropped table: " . $table . "\n";
        }
    }


    public function seed()
    {
        $menu = new \common\models\menu\Menu(['id_site' => 'console', 'url'=>'menu1']);
        $menu->save();
        $menuInfo = new \common\models\menu\MenuInfo([
            'name' => 'my menu name',
            'description' => 'my menu description',
            'language' => 'da',
            'id_menu' => $menu->id
        ]);
        $menuInfo->save();
        $menuInfo2 = new \common\models\menu\MenuInfo([
            'name' => 'my menu name2',
            'description' => 'my menu description2',
            'language' => 'en',
            'id_menu' => $menu->id
        ]);
        $menuInfo2->save();

        for($i = 0; $i <10; $i++){
            $menuItem = new \common\models\menu\MenuItem([
                'id_menu' => $menu->id,
                'item_number' => $i,
            ]);
            $menuItem->save();
            $menuItemInfo1 = new \common\models\menu\MenuItemInfo([
                'id_menu_item' => $menuItem->id,
                'language' => 'da',
                'name' => 'dansk menu ' . $i,
                'description' => 'dansk beskrivelse ' . $i,
                'price' => 7500,
                'currency' => 'dkk'
            ]);
            $menuItemInfo1->save();

            if(rand(0,1))
            {
                $menuItemInfo2 = new \common\models\menu\MenuItemInfo([
                    'id_menu_item' => $menuItem->id,
                    'language' => 'de',
                    'name' => 'deutsche menu ' . $i,
                    'description' => 'deutsche beskrivelse ' . $i,
                    'price' => 1000,
                    'currency' => 'eur'
                ]);
                $menuItemInfo2->save();
            }
            if(rand(0,1))
            {
                $menuItemInfo3 = new \common\models\menu\MenuItemInfo([
                    'id_menu_item' => $menuItem->id,
                    'language' => 'en',
                    'name' => 'english menu ' . $i,
                    'description' => 'english beskrivelse ' . $i,
                    'price' => 750,
                    'currency' => 'gbp'
                ]);
                $menuItemInfo3->save();
            }
        }
    }
}
