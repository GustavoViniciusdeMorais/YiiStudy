<?php

namespace app\modules\gustavo;

class Module extends \yii\base\Module
{
    public $test = 'test module';
    
    public function init()
    {
        parent::init();

        $this->params['foo'] = 'bar';
        // ...  other initialization code ...
    }
}
