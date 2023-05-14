# Build Module

```
```

### ./config/web.php
This is how we load modules
```php
$config = [
    'modules' => [
            'gustavo' => [
                'class' => 'app\modules\gustavo\Module',
                // ... other configurations for the module ...
            ],
        ],
]
```

### ./modules/gustavo/Module.php
```php
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

```
### Call module
Call the module
```php
$gusModule = \Yii::$app->getModule('gustavo');
$dataFromModule = $gusModule->params['foo'];
```
