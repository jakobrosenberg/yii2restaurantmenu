<?php

namespace Simpletree\Restaurantmenu;


class module extends \yii\base\Module
{
//	public $controllerNamespace = 'Simpletree\Restaurantmenu\controllers';

	public function init()
	{
        $this->layout = 'main';
        parent::init();
		// custom initialization code goes here
	}
}
