<?php

namespace frontend\modules\blog;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\blog\controllers';

    public $layout = 'blog';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
