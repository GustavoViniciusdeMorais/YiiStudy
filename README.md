# Yii Framework Example

Created by: Gustavo Morais

[Simple Tutorial](https://www.yiiframework.com/doc/guide/2.0/en/start-gii)
<br>
[Rest API](https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start)

```

sudo docker-compose up -d --build

sudo docker exec -it yiinginx bash

```

### Advanced Template
Type the following command to initialize the advanced project
```
php init
```

# yiibkp container
```
sudo docker commit 3cd8d2213e81 yiibkp
FROM yiibkp

./startServices.sh

```

### DB Setup
```

# at ubuntu project folder
sudo cp dbExample.sql dockerDBData/dbExample.sql

sudo docker exec -it yiimysql sh
use laravel
source /var/lib/mysql/dbExample.sql

http://localhost/index.php?r=country%2Findex

```

### Generated CRUD Project
Links
```
http://localhost/backend/web/project
http://localhost/backend/web/gii
```
Config access to gii from inside docker
add the instruction 'allowedIPs' => ['127.0.0.1', '::1', $_SERVER['REMOTE_ADDR']]
#### ./environments/dev/backend/config/main-local.php
```php
if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
    ];
    
    $config['bootstrap'][] = 'gii';
    //'class' => \yii\gii\Module::class,
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        'allowedIPs' => ['127.0.0.1', '::1', $_SERVER['REMOTE_ADDR']],
    ];
}
```
#### Run the command
This command writes the env dev configs to the backend folder
```
php init
```
